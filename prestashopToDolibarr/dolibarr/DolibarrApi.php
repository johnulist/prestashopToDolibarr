<?php

include('DolibarrThirdParty.php');
include('DolibarrContact.php');
include('DolibarrProduct.php');
include('DolibarrOrder.php');
include('DolibarrInvoice.php');

include('DolibarrAuthentication.php');

class Dolibarr {
	private static $_instance = null;
	
	private $authentication;
	private $dolibarr_server_url;
	private $client_other;
	private $client_thirdparty;
	private $client_contact;
    private $client_product;
    private $client_order;
    private $client_invoice;
	
	private function initAuthentication() {
		// load credentials
		$this->dolibarr_server_url = Configuration::get('dolibarr_server_url');
		$this->authentication = new DolibarrAuthentication();
		$this->authentication->dolibarrkey = Configuration::get('dolibarr_key');
		$this->authentication->sourceapplication="prestashop module prestashopToDolibarr";
		$this->authentication->login = Configuration::get('dolibarr_login');
		$this->authentication->password = Configuration::get('dolibarr_password');
	}

	private function __construct() {
		$this->initAuthentication();
		// init webservice client
		$this->client_other = new SoapClient($this->dolibarr_server_url."/webservices/server_other.php?wsdl");
		$this->client_thirdparty = new SoapClient($this->dolibarr_server_url."/webservices/server_thirdparty.php?wsdl");
		$this->client_contact = new SoapClient($this->dolibarr_server_url."/webservices/server_contact.php?wsdl");
		$this->client_product = new SoapClient($this->dolibarr_server_url."/webservices/server_productorservice.php?wsdl");
		$this->client_order = new SoapClient($this->dolibarr_server_url."/webservices/server_order.php?wsdl");
		$this->client_invoice = new SoapClient($this->dolibarr_server_url."/webservices/server_invoice.php?wsdl");
	}

	public static function getInstance() {
		if(is_null(self::$_instance)) {
			self::$_instance = new Dolibarr();
		}
		return self::$_instance;
	}
	
	public static function reset() {
		self::$_instance = null;
	}
	
    /********** Methods for other **********/
    public function getVersions() {
		$params = array(
		  "authentication" => $this->authentication,
		);

		return $this->client_other->__soapCall("getVersions", $params);
	}
    
    /********** Methods for users **********/
	public function getUser($ref_ext) {
		$params = array(
		  "authentication" => $this->authentication,
          "id" => "",
          "ref" => "",
		  "ref_ext" => $ref_ext
		);

		return $this->client_thirdparty->__soapCall("getThirdParty", $params);
	}

	public function createUser($thirdParty) {
		$params = array(
		  "authentication" => $this->authentication,
		  "thirdparty" => $thirdParty
		);

		return $this->client_thirdparty->__soapCall("createThirdParty", $params);
	}

	public function updateUser($thirdParty) {
		$params = array(
		  "authentication" => $this->authentication,
		  "thirdparty" => $thirdParty
		);

		return $this->client_thirdparty->__soapCall("updateThirdParty", $params);
	}
	
	public function getUsers() {
		$params = array(
		  "authentication" => $this->authentication,
		  "filterthirdparty" => ""
		);

		return $this->client_thirdparty->__soapCall("getListOfThirdParties", $params);
	}
	
	/********** Methods for contacts **********/
	public function getContact($ref_ext) {
		$params = array(
		  "authentication" => $this->authentication,
          "id" => "", 
          "ref_ext" => $ref_ext
		);

		return $this->client_contact->__soapCall("getContact", $params);
	}

	public function createContact($thirdParty) {
		$params = array(
		  "authentication" => $this->authentication,
		  "contact" => $thirdParty
		);

		return $this->client_contact->__soapCall("createContact", $params);
	}

	public function updateContact($thirdParty) {
		$params = array(
		  "authentication" => $this->authentication,
		  "contact" => $thirdParty
		);

		return $this->client_contact->__soapCall("updateContact", $params);
	}
	
	public function getContactsForThirdParty($id_third_party) {
		$params = array(
		  "authentication" => $this->authentication,
		  "idthirdparty" => $id_third_party
		);

		return $this->client_contact->__soapCall("getListOfContactsForThirdParty", $params);
	}

    /********** Methods for products **********/

	public function getProduct($ref_ext) {
		$params = array(
		  "authentication" => $this->authentication,
          "id" => "",
          "ref" => "",
		  "ref_ext" => $ref_ext
		);

		return $this->client_product->__soapCall("getProductOrService", $params);
	}

	public function createProduct($product) {
		$params = array(
		  "authentication" => $this->authentication,
		  "product" => $product
		);

		return $this->client_product->__soapCall("createProductOrService", $params);
	}

	public function updateProduct($product) {
		$params = array(
		  "authentication" => $this->authentication,
		  "product" => $product
		);

		return $this->client_product->__soapCall("updateProductOrService", $params);
	}
	
	/********** Methods for orders **********/

	public function getOrder($ref_ext) {
		$params = array(
		  "authentication" => $this->authentication,
          "id" => "",
          "ref" => "",
		  "ref_ext" => $ref_ext
		);

		$response = $this->client_order->__soapCall("getOrder", $params);
		var_dump($response);

		return $response;
	}

	public function createOrder($order) {
		$params = array(
		  "authentication" => $this->authentication,
		  "order" => $order
		);
		var_dump($params);
		$response = $this->client_order->__soapCall("createOrder", $params);
		var_dump($response);

		return $response;
	}

	public function updateOrder($order) {
		$params = array(
		  "authentication" => $this->authentication,
		  "order" => $order
		);

		$response = $this->client_order->__soapCall("updateOrder", $params);
		var_dump($response);
		return $response;
	}
	
	/********** Methods for invoices **********/

	public function getInvoice($ref_ext) {
		$params = array(
		  "authentication" => $this->authentication,
          "id" => "",
          "ref" => "",
		  "ref_ext" => $ref_ext
		);

		$response = $this->client_invoice->__soapCall("getInvoice", $params);
		var_dump($response);

		return $response;
	}

	public function createInvoice($invoice) {
		$params = array(
		  "authentication" => $this->authentication,
		  "invoice" => $invoice
		);

		var_dump($params);
		$response = $this->client_invoice->__soapCall("createInvoice", $params);
		var_dump($response);

		return $response;
	}

	public function updateInvoice($invoice) {
		$params = array(
		  "authentication" => $this->authentication,
		  "invoice" => $invoice
		);

		$response = $this->client_invoice->__soapCall("updateInvoice", $params);
		var_dump($response);
		return $response;
	}
}

?>
