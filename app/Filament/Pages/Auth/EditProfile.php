<?php


namespace App\Filament\Pages\Auth;

use Filament\Auth\Pages\EditProfile as BaseEditProfile;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class EditProfile extends BaseEditProfile
{
    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('username')->required()->maxLength(255),

                TextInput::make('fname')->required()->maxLength(255),
                TextInput::make('umname')->required()->maxLength(255),
                TextInput::make('lname')->required()->maxLength(255),
                TextInput::make('phone')->required()->maxLength(255),
                TextInput::make('address')->required()->maxLength(255),
                TextInput::make('branch_id')->required()->maxLength(255),
                TextInput::make('role')->required()->maxLength(255),



                $this->getFnameFormComponent(),
                $this->getMnameFormComponent(),
                $this->getMameFormComponent(),
                $this->getPhoneFormComponent(),
                $this->getAddressFormComponent(),
                $this->getBranchFormComponent(),
                $this->getRoleFormComponent(),


                $this->getNameFormComponent(),
                $this->getEmailFormComponent(),
                $this->getPasswordFormComponent(),
                $this->getPasswordConfirmationFormComponent(),
            ]);
    }
}
