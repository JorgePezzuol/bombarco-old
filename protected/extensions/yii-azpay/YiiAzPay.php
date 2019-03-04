<?php
/**
*
* Yii AZ Pay Extension
*
**/

Yii::import('application.vendor.azpay-sdk.*');

class YiiAzPay extends AZPay {

	# Key and ID of the client
	public $merchant = array(
		'id' => '',
		'key' => ''
	);

	# Order
	public $config_order = array(
		'reference' => '',
		'totalAmount' => ''
	);

	# Billing
	public $config_billing = array(
		'customerIdentity' => '1',
		'name' => 'Fulano de Tal',
		'address' => 'Av. Federativa, 238',
		'address2' => '10 Andar',
		'city' => 'Mogi das Cruzes',
		'state' => 'SP',
		'postalCode' => '20031-170',
		'country' => 'BR',
		'phone' => '21 4009-9400',
		'email' => 'fulanodetal@email.com'
	);

	# Card Payment
	public $config_card_payments = array(
		'acquirer' => '1',
		'method' => '1',
		'amount' => 'R$ 0,00',
		'currency' => 986,
		'country' => 'BRA',
		'numberOfPayments' => '1',
		'groupNumber' => '0',
		'flag' => 'mastercard',
		'cardHolder' => '',
		'cardNumber' => '',
		'cardSecurityCode' => '123',
		'cardExpirationDate' => '2018-05',
		'saveCreditCard' => 'true',
		'generateToken' => 'false',
		'departureTax' => '0',
		'softDescriptor' => ''
	);

	# Boleto
	public $config_boleto = array(
		'acquirer' => '10',
		'expire' => '',
		'nrDocument' => '',
		'amount' => '000',
		'currency' => 986,
		'country' => 'BRA',
		'instructions' => ''
	);

	# Options
	public $config_options = array(
		'urlReturn' => '',
		'fraud' => 'false',
		'customField' => ''
	);

	function __construct($merchant_id, $merchant_key) {

		parent::__construct($merchant_id, $merchant_key);

	}

	public function cardPayment() {

		return $this->config_billing;

	}

}
?>