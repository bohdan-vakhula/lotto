<?php

require dirname(__FILE__) . '/../Data/Data.php';

class Users extends Data
{
    public function signup()
    {
        $data = $_POST;

        if (isset($this->postData['firstname'])) {
            $data['firstName'] = str_replace('\\', '', $this->postData['firstname']);
        }
        if (isset($this->postData['lastname'])) {
            $data['lastName']  = str_replace('\\', '', $this->postData['lastname']);
        }

        $lang_code = (defined('ICL_LANGUAGE_CODE')) ? ICL_LANGUAGE_CODE : 'en';
        $langs_id = array(
            'en' => 1,
            'he' => 2,
            'fr' => 3,
            'ru' => 4,
            'de' => 5,
            'it' => 6,
            'es' => 7,
            'nl' => 8,
            'fi' => 9,
            'se' => 10,
            'lv' => 11,
            'ro' => 12,
            'ar' => 13,
            'pl' => 14,
            'cs' => 15,
            'tr' => 16
        );

        $data['LanguageId']  = $langs_id[$lang_code];
        $data['PhoneNumber'] = $this->postData['phone'];
        $data['AffiliateId'] = empty($_SESSION['bta']) ? 0 : $_SESSION['bta'];
        $data['cxd']         = empty($_SESSION['cxd']) ? 0 : $_SESSION['cxd'];
        $data['BrandID']     = BRAND_ID;
        $data['IP']          = $_SERVER['REMOTE_ADDR'];
        $data['CountryCode'] = $_SESSION['user_maxmind_data']['country_code'];

        $this->processedData = $data;
    }

    public function login()
    {
        $this->processedData = array(
            'email'    => $this->postData['email'],
            'password' => $this->postData['password'],
            'brandId'  => BRAND_ID,
        );
    }

    public function updatePersonalDetails()
    {
        $fname = $this->postData['first_name'];

        if(empty($fname)) {
            $fname = $_SESSION['user_data']['FirstName'];
        }
        
        $memberId = 0;
        $password = '';

        if (count($_SESSION['user_data']) > 0) {
            $memberId = $_SESSION['user_data']['MemberId'];
            $password = $_SESSION['user_data']['Password'];
        }

        $this->processedData = array(
            'Email'        => $_SESSION['user_data']['Email'],
            'Password'     => $password,
            'FirstName'    => $fname,
            'LastName'     => str_replace('\\', '', $this->postData['last_name']),
            'MemberId'     => $memberId,
            'PhoneNumber'  => $this->postData['phone'],
            'MobileNumber' => $this->postData['mobno'],
            'CountryCode'  => $this->postData['country'],
            'Address'      => $this->postData['address'],
            'City'         => $this->postData['city'],
            'State'        => $this->postData['state'],
            'ZipCode'      => $this->postData['zipcode'],
            'BrandID'      => BRAND_ID,
            'IP'           => $_SERVER['REMOTE_ADDR'],
        );
    }

    public function getPersonalDetailsByMemberid()
    {
        $this->processedData = array(
            'MemberId' => (count($_SESSION['user_data']) > 0) ? $_SESSION['user_data']['MemberId'] : 0,
            'BrandID'  => BRAND_ID,
            'IP'       => $_SERVER['REMOTE_ADDR'],
        );
    }

    public function updatePassword()
    {
        if (!empty($_SESSION['user_data'])) {
            $memberID = $_SESSION['user_data']['MemberId'];
        }

        if (!empty($_SESSION['ResetMemberId'])) {
            $memberID = $_SESSION['ResetMemberId'];
            $_SESSION['user_data']['MemberId'] = $memberID;
        }

        $this->processedData = array(
            'Email'       => $this->postData['email'],
            'Password'    => $this->postData['password'],
            'Oldpassword' => $this->postData['oldpassword'],
            'MemberId'    => $memberID,
            'BrandID'     => BRAND_ID,
            'IP'          => $_SERVER['REMOTE_ADDR'],
        );
    }

    public function getCreditCardMethodsByMemberid()
    {
        $this->processedData = array(
            'MemberId' => $_SESSION['user_data']['MemberId'],
            'BrandID'  => BRAND_ID,
            'IP'       => $_SERVER['REMOTE_ADDR'],
        );
    }

    public function getTransactionsByMemberid()
    {
        $this->processedData = array(
            'MemberId'   => $_SESSION['user_data']['MemberId'],
            'BrandID'    => BRAND_ID,
            'PageNumber' => $this->postData['PageNumber'],
            'PageSize'   => $this->postData['PageSize'],
        );
    }

    public function deleteCreditCard()
    {
        $this->processedData = array(
            'MemberId' => $_SESSION['user_data']['MemberId'],
            'BrandID'  => BRAND_ID,
            'ID'       => $this->postData['id'],
        );
    }

    public function getMemberMoneyBalance()
    {
        if (count($_SESSION['user_data']) > 0) {
            $this->processedData = array(
                'MemberId' => $_SESSION['user_data']['MemberId'],
                'BrandID'  => BRAND_ID,
            );
        }
    }

    public function getPersonalDetailsByEmail()
    {
        $this->processedData = array('Email' => $this->postData['email'], 'BrandID' => BRAND_ID);
    }

    public function addUpdateCreditCard()
    {
        $cardtype = ($this->postData['cardid'] == 0) ? $this->postData['card'] : $this->postData['cardtype'];

        $date     = $this->postData['year'] . '-' . $this->postData['month'];
        $d        = date_create_from_format('Y-m', $date);
        $last_day = date_format($d, 't');
        $date     = $this->postData['year'] . '-' . $this->postData['month'] . '-' . $last_day;

        $this->processedData = array(
            'MemberId'       => $_SESSION['user_data']['MemberId'],
            'BrandID'        => BRAND_ID,
            'ID'             => $this->postData['cardid'],
            'CardHolderName' => $this->postData['fullname'],
            'ExpirationDate' => $date,
            'CVV'            => $this->postData['cvv'],
            //'CardType'       => $cardtype
        );

        if ($this->postData['cardid'] == 0) {
            $this->processedData['CreditCardNumber'] = $this->postData['card_num'];
        }
    }
}
