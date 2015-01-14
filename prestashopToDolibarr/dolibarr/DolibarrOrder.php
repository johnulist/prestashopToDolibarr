<?php
/*<xsd:complexType name="order"><xsd:all><xsd:element name="id" type="xsd:string"/><xsd:element name="ref" type="xsd:string"/><xsd:element name="ref_client" type="xsd:string"/><xsd:element name="ref_ext" type="xsd:string"/><xsd:element name="ref_int" type="xsd:string"/><xsd:element name="thirdparty_id" type="xsd:int"/><xsd:element name="status" type="xsd:int"/><xsd:element name="facturee" type="xsd:string"/><xsd:element name="total_net" type="xsd:double"/><xsd:element name="total_vat" type="xsd:double"/><xsd:element name="total_localtax1" type="xsd:double"/><xsd:element name="total_localtax2" type="xsd:double"/><xsd:element name="total" type="xsd:double"/><xsd:element name="date" type="xsd:date"/><xsd:element name="date_creation" type="xsd:dateTime"/><xsd:element name="date_validation" type="xsd:dateTime"/><xsd:element name="date_modification" type="xsd:dateTime"/><xsd:element name="remise" type="xsd:string"/><xsd:element name="remise_percent" type="xsd:string"/><xsd:element name="remise_absolue" type="xsd:string"/><xsd:element name="source" type="xsd:string"/><xsd:element name="note_private" type="xsd:string"/><xsd:element name="note_public" type="xsd:string"/><xsd:element name="project_id" type="xsd:string"/><xsd:element name="mode_reglement_id" type="xsd:string"/><xsd:element name="mode_reglement_code" type="xsd:string"/><xsd:element name="mode_reglement" type="xsd:string"/><xsd:element name="cond_reglement_id" type="xsd:string"/><xsd:element name="cond_reglement_code" type="xsd:string"/><xsd:element name="cond_reglement" type="xsd:string"/><xsd:element name="cond_reglement_doc" type="xsd:string"/><xsd:element name="date_livraison" type="xsd:date"/><xsd:element name="fk_delivery_address" type="xsd:int"/><xsd:element name="demand_reason_id" type="xsd:string"/><xsd:element name="lines" type="tns:LinesArray2"/></xsd:all></xsd:complexType>*/

class DolibarrOrderLines {
    public $id;
	public $type; // nom
	public $desc;
    public $vate_rate;
    public $qty;
    public $unitprice;
    public $total_net;
    public $total_vat;
    public $total;
	public $date_start = ""; // dateTime
	public $date_end = ""; // dateTime
	public $product_id = "";
	public $product_ref = "";
	public $product_label = "";
	public $product_desc = "";
}

class DolibarrOrder {
    public $id;
	public $ref; // nom
	public $ref_client;
	public $ref_ext;
	public $ref_int;
    public $thirdparty_id;
	public $status = 1; // -1=Canceled, 0=Draft, 1=Validated, (2=Accepted/On process not managed for customer orders), 3=Closed (Sent/Received, billed or not)
	public $facturee;
	public $total_net;
    public $total_vat;
    public $total_localtax1;
    public $total_localtax2;
    public $total;
    public $date = ""; // dateTime
	public $date_creation = ""; // dateTime
	public $date_validation = ""; // dateTime
	public $date_modification = ""; // dateTime
	public $remise;
	public $remise_percent;
	public $remise_absolue;
	public $source;
	public $note_private = "Synchronised from Prestashop";
    public $note_public = "";
    public $project_id = "";
    public $mode_reglement_id;
    public $mode_reglement_code;
    public $mode_reglement;
    public $cond_reglement_id;
    public $cond_reglement_code;
    public $cond_reglement;
    public $cond_reglement_doc;
    public $date_livraison; //dateTime
    public $fk_delivery_address;
    public $demand_reason_id;
    public $lines = array(); // array of DolibarrOrderLines
}

?>