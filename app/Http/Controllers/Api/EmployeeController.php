<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Services\LdapService;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    protected $ldapService;

    public function __construct(LdapService $ldapService)
    {
        $this->ldapService = $ldapService;
        // Add authentication middleware if needed
        // $this->middleware('auth:sanctum')->except(['index', 'show', 'search']);
    }

    /**
     * Get all employees from local database
     */
    public function index(Request $request)
    {
        // ... same implementation as before
    }

    /**
     * Search employees in AD
     */
    public function searchAd(Request $request)
    {
        try {
            $filters = $request->only(['search', 'department', 'title']);
            $limit = $request->get('limit', 50);

            $employees = $this->ldapService->searchEmployees($filters, $limit);

            return response()->json([
                'success' => true,
                'data' => $employees,
                'message' => 'Employees retrieved from AD',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to search AD: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Get employee from AD by username
     */
    public function getFromAd($username)
    {
        try {
            $employee = $this->ldapService->getEmployeeByUsername($username);

            if (!$employee) {
                return response()->json([
                    'success' => false,
                    'message' => 'Employee not found in AD',
                ], 404);
            }

            return response()->json([
                'success' => true,
                'data' => $employee,
                'message' => 'Employee retrieved from AD',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to get employee from AD: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Test LDAP connection
     */
    public function testLdap()
    {
        try {
            $result = $this->ldapService->testConnection();

            return response()->json([
                'success' => $result['success'],
                'message' => $result['message'],
                'data' => $result,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Connection test failed: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Get departments from AD
     */
    public function departmentsFromAd()
    {
        try {
            $departments = $this->ldapService->getDepartments();

            return response()->json([
                'success' => true,
                'data' => $departments,
                'message' => 'Departments retrieved from AD',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to get departments: ' . $e->getMessage(),
            ], 500);
        }
    }
}
