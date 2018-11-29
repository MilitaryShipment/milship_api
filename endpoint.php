<?php

// require_once '/srv/www/htdocs/classes/API/agent.php';
// require_once '/srv/www/htdocs/classes/API/vendor.php';
// require_once '/srv/www/htdocs/classes/API/driver.php';
// require_once '/srv/www/htdocs/classes/API/lumper.php';
// require_once '/srv/www/htdocs/classes/API/dispatcher.php';
// require_once '/srv/www/htdocs/classes/API/contact.php';
// require_once '/srv/www/htdocs/classes/API/shipment.php';
// require_once '/srv/www/htdocs/classes/API/utility.php';
// require_once '/srv/www/htdocs/classes/API/auth.php';
// require_once '/srv/www/htdocs/classes/API/tonnage.php';
// require_once '/srv/www/htdocs/classes/API/invoice.php';
// require_once '/srv/www/htdocs/classes/API/cog.php';


require_once __DIR__ . '/api.php';
require_once __DIR__ . '/../ms_core/models/ops/Shipment.php';
require_once __DIR__ . '/../ms_core/models/ops/Agent.php';
require_once __DIR__ . '/../ms_core/models/ops/Contact.php';
require_once __DIR__ . '/../ms_core/models/ops/Driver.php';

class EndPoint extends API{

  public function __construct($request,$origin){
    parent::__construct($request);
  }
  protected function example(){
    return array("endPoint"=>$this->endpoint,"verb"=>$this->verb,"args"=>$this->args,"request"=>$this->request);
  }
  protected function shipment(){
    $data = null;
    if($this->method == 'GET' && isset($this->verb) && !count($this->args)){
      //get specific shipment
      $data = new Shipment($this->verb);
    }elseif($this->method == 'GET' && !isset($this->verb)){
      //get all
      $data = Shipment::get("status_id",1,"active");
    }elseif($this->method == 'GET' && isset($this->verb) && count($this->args)){
      //get shipment with args
      $data = $this->_parseShipmentArgs();
    }elseif($this->method == 'POST' && !isset($this->verb)){
      //create
      throw new \Exception('Cannot POST here.');
    }elseif($this->method == 'PUT' && isset($this->verb)){
      //update
      $data = new Shipment($this->verb);
      $data->setFields($this->file)->update();
    }else{
      throw new \Exception('Unsupported request');
    }
    return $data;
  }
  protected function agent(){
    $data = null;
    if($this->method == 'GET' && isset($this->verb) && !count($this->args)){
      //get specific agent
      $data = new Agent($this->verb);
    }elseif($this->method == 'GET' && !isset($this->verb)){
      //get all
    }elseif($this->method == 'GET' && isset($this->verb) && count($this->args)){
      //get with args
      $data = $this->_parseAgentArgs();
    }elseif($this->method == 'POST' && !isset($this->verb)){
      //create
      throw new \Exception('Cannot POST here.');
    }elseif($this->method == 'PUT' && isset($this->verb)){
      //update
      $data = new Agent($this->verb);
      $data->setFields($this->file)->update();
    }else{
      throw new \Exception('Unsupported request');
    }
    return $data;
  }
  protected function driver(){
    $data = null;
    if($this->method == 'GET' && isset($this->verb) && !count($this->args)){
      //get specific
      $data = new Driver($this->verb);
    }elseif($this->method == 'GET' && !isset($this->verb)){
      //get all
      $data = Driver::get("status_id",1);
    }elseif($this->method == 'GET' && isset($this->verb) && count($this->args)){
      //get with args
    }elseif($this->method == 'POST' && !isset($this->verb)){
      //create
      throw new \Exception('Cannot POST here.');
    }elseif($this->method == 'PUT' && isset($this->verb)){
      //update
      $data = new Driver($this->verb);
      $data->setFields($this->file)->update();
    }else{
      throw new \Exception('Unsupported request');
    }
    return $data;
  }
  protected function labor(){
    $data = null;
    if($this->method == 'GET' && isset($this->verb) && !count($this->args)){
      //get specific
    }elseif($this->method == 'GET' && !isset($this->verb)){
      //get all
    }elseif($this->method == 'GET' && isset($this->verb) && count($this->args)){
      //get with args
    }elseif($this->method == 'POST' && !isset($this->verb)){
      //create
      throw new \Exception('Cannot POST here.');
    }elseif($this->method == 'PUT' && isset($this->verb)){
      //update
    }else{
      throw new \Exception('Unsupported request');
    }
    return $data;
  }
  protected function dispatch(){
    $data = null;
    if($this->method == 'GET' && isset($this->verb) && !count($this->args)){
      //get specific
    }elseif($this->method == 'GET' && !isset($this->verb)){
      //get all
    }elseif($this->method == 'GET' && isset($this->verb) && count($this->args)){
      //get with args
    }elseif($this->method == 'POST' && !isset($this->verb)){
      //create
      throw new \Exception('Cannot POST here.');
    }elseif($this->method == 'PUT' && isset($this->verb)){
      //update
    }else{
      throw new \Exception('Unsupported request');
    }
    return $data;
  }
  protected function vendor(){
    $data = null;
    if($this->method == 'GET' && isset($this->verb) && !count($this->args)){
      //get specific
    }elseif($this->method == 'GET' && !isset($this->verb)){
      //get all
    }elseif($this->method == 'GET' && isset($this->verb) && count($this->args)){
      //get with args
    }elseif($this->method == 'POST' && !isset($this->verb)){
      //create
      throw new \Exception('Cannot POST here.');
    }elseif($this->method == 'PUT' && isset($this->verb)){
      //update
    }else{
      throw new \Exception('Unsupported request');
    }
    return $data;
  }
  protected function contact(){
    $data = null;
    if($this->method == 'GET' && count($this->args)){
      //get specific
      $data = new Contact($this->args[0]);
    }elseif($this->method == 'GET' && !isset($this->verb) && !count($this->args)){
      //get all
      $data = Contact::get("status_id",1);
    }elseif($this->method == 'POST' && !isset($this->verb)){
      //create
      throw new \Exception('Cannot POST here.');
    }elseif($this->method == 'PUT' && isset($this->verb)){
      //update
      $data = new Contact($this->verb);
      $data->setFields($this->file)->update();
    }else{
      throw new \Exception('Unsupported request');
    }
    return $data;
  }
  protected function _parseShipmentArgs(){
    $shipment = new Shipment($this->verb);
    $data = null;
    switch(strtolower($this->args[0])){
      case "notifications":
        $data = $shipment->getNotifications();
      break;
      case "responses":
        $data = $shipment->getResponses();
      break;
      case "labor":
        $data = $shipment->getLabor();
      break;
      case "oapaperwork":
        $data = $shipment->getOaPaperWork();
      break;
      case "pendingppwk":
        $data = $shipment->getPendingPpwk();
      break;
      case "dappwk":
        $data = null;
      break;
      case "epayimages":
        $data = $shipment->getEpayImages();
      break;
      case "oa":
        $data = $shipment->getOA();
      break;
      case "da":
        $data = $shipment->getDA();
      break;
      case "ha":
        $data = $shipment->getHA();
      break;
      case "hc":
        $data = $shipment->getHaulerCarrier();
      break;
      case "claims":
        $data = $shipment->getClaims();
      break;
      case "driver":
        $data = $shipment->getDriver();
      break;
      default:
        throw new \Exception('Invalid Argument');
    }
    return $data;
  }
  protected function _parseAgentArgs(){
    $data = null;
    $agent = new Agent($this->verb);
    switch(strtolower($this->args[0])){
      case "drivers":
        $data = $agent->getDrivers();
      break;
      case "labor":
        $data = $agent->getLumpers();
      break;
      case "dispatchers":
        $data = $agent->getDispatchers();
      break;
      case "contacts":
        $data = $agent->getContacts();
      break;
      case "vendor":
        $data = $agent->getVendorData();
      break;
      case "shipments":
        $data = $agent->getshipments($this->args[1]);
      break;
      case "epayimages":
        $data = $agent->getEpayImages($this->args[1]);
      break;
      case "remittance":
        $data = $agent->getRemittance($this->args[1]);
      break;
      case "paperwork":
        $data = $agent->getPendingPpwk();
      break;
      case "claims":
        $data = $agent->getClaims($this->args[1]);
      break;
      case "docs":
        $data = $agent->getClaimDocs($this->args[1]);
      break;
      case "blackouts":
        $data = $agent->getBlackOuts($this->args[1]);
      break;
      case "users":
        $data = $agent->getWebUsers();
      break;
      case "contracts":
        $data = $agent->getContracts();
      break;
      default:
        throw new \Exception('Invalid Argument');
    }
    return $data;
  }
  protected function _parseDriverArgs(){
    $data = null;
    switch(strtolower($this->args[0])){
      case "notifications":
      break;
      case "responses":
      break;
      case "labor":
      break;
      case "shipments":
      break;
      case "settlements":
      break;
      case "dispatchers":
      break;
      default:
        throw new \Exception('Invalid Argument');
    }
    return $data;
  }
}



require_once '/srv/www/htdocs/classes/movestar/agentTranslation.php';

class EndPoint extends API{

    public function __construct($request,$origin)
    {
        parent::__construct($request);
    }
    protected function example(){
        return array("endPoint"=>$this->endpoint,"verb"=>$this->verb,"args"=>$this->args,"request"=>$this->request);
    }
    protected function shipment(){
        $data = null;
        if($this->method == 'GET' && isset($this->verb)){
          //get specific shipment
          $data = new Shipment($this->verb);
        }elseif($this->method == 'GET' && !isset($this->verb)){
          //get all
          $data = Shipment::get("status_id",1,"active");
        }elseif($this->method == 'POST' && !isset($this->verb)){
          //create
          throw new \Exception('Cannot POST here.');
        }elseif($this->method == 'PUT' && isset($this->verb)){
          //update
          $data = new Shipment($this->verb);
          $data->setFields($this->file)->update();
        }else{
          throw new \Exception('Unsupported request');
        }
        return $data;
    }
    protected function auth(){
        $endPoint = new AuthEndPoint($this->verb,$this->args,$this->request);
        return $endPoint->returnVal;
    }
    protected function agents(){
        $endPoint = new AgentEndPoint($this->verb,$this->args,$this->request);
        return $endPoint->returnVal;
    }
    protected function vendors(){
        $endPoint = new VendorEndPoint($this->verb,$this->args,$this->request);
        return $endPoint->returnVal;
    }
    protected function drivers(){
        $endPoint = new DriverEndPoint($this->verb,$this->args,$this->request);
        return $endPoint->returnVal;
    }
    protected function lumpers(){
        $endPoint = new LumperEndPoint($this->verb,$this->args,$this->request);
        return $endPoint->returnVal;
    }
    protected function dispatchers(){
        $endPoint = new DispatchEndPoint($this->verb,$this->args,$this->request);
        return $endPoint->returnVal;
    }
    protected function contacts(){
        $endPoint = new ContactEndPoint($this->verb,$this->args,$this->request);
        return $endPoint->returnVal;
    }
    protected function tonnage(){
        $endPoint = new TonnageEndPoint($this->verb,$this->args,$this->request);
        return $endPoint->returnVal;
    }
    protected function invoice(){
        $endPoint = new InvoiceEndPoint($this->verb,$this->args,$this->request);
        return $endPoint->returnVal;
    }
    protected function cog(){
        switch ($this->verb){
            case "get":
                $c = new Cog($this->args[0]);
                break;
            default:
                throw new Exception('Unsupported Verb');
        }
        return $c;
    }
    protected function util(){
        $endPoint = new UtilityEndPoint($this->verb,$this->args,$this->request);
        return $endPoint->returnVal;
    }
    protected function upload(){}
}


class DriverEndPoint{

    public $verb;
    public $args;
    public $request;
    public $driver;
    public $returnVal;
    private $driver_id;

    public function __construct($verb,$args = null, $request = null)
    {
        $this->verb = $verb;
        $this->args = $args;
        $this->driver_id = $this->args[0];
        $this->request = $request;
        $this->driver = new Driver($this->driver_id);
        $this->switchVerb();
    }
    private function switchVerb(){
        switch ($this->verb){
            case "get":
                $this->getWhat();
                break;
            case "create":
                $this->driver->setFields($this->request)->create();
                $this->returnVal = $this->driver;
                break;
            case "update":
                $this->driver->setFields($this->request)->update();
                $this->returnVal = $this->driver;
                break;
            default:
                throw new Exception('Unsupported Verb');
        }
        return $this;
    }
    private function getWhat(){
        if(count($this->args) <= 1){
            $this->returnVal = $this->driver;
        }else{
            switch ($this->args[1]){
                case "notifications":
                    $this->returnVal = $this->driver->getNotifications();
                    break;
                case "responses":
                    $this->returnVal = $this->driver->getResponses();
                    break;
                case "lumpers":
                    $this->returnVal = $this->driver->getLumpers();
                    break;
                case "shipments":
                    $this->returnVal = $this->driver->getActiveShipments();
                    break;
                case "shipmentHistory":
                    $this->returnVal = $this->driver->getArchiveShipments();
                    break;
                case "settlements":
                    $this->returnVal = $this->driver->getSettlements();
                    break;
                case "dispatchers":
                    $this->returnVal = $this->driver->getDispatchers();
                    break;
                default:
                    throw new Exception('Unsupported Argument');
            }
        }
        return $this;
    }
}
class VendorEndPoint{

    public $verb;
    public $args;
    public $request;
    public $vendor;
    public $returnVal;
    private $vendor_number;

    public function __construct($verb,$args = null, $request = null)
    {
        $this->verb = $verb;
        $this->args = $args;
        $this->vendor_number = $this->args[0];
        $this->request = $request;
        $this->vendor = new Vendor($this->vendor_number);
        $this->switchVerb();
    }
    private function switchVerb(){
        switch ($this->verb){
            case "get":
                $this->getWhat();
                break;
            case "create":
                $this->vendor->setFields($this->request)->create();
                $this->returnVal = $this->vendor;
                break;
            case "update":
                $this->vendor->setFields($this->request)->update();
                $this->returnVal = $this->vendor;
                break;
            default:
                throw new Exception('Unsupported Verb');
        }
        return $this;
    }
    private function getWhat(){
        if(count($this->args) <= 1){
            $this->returnVal = $this->vendor;
        }else{
            switch ($this->args[1]){
                case "epayImages":
                    $this->returnVal = $this->vendor->getEpayImages();
                    break;
                case "ach":
                    $this->returnVal = $this->vendor->getAchInfo();
                    break;
                default:
                    throw new Exception('Unsupported Argument');
            }
        }
        return $this;
    }

}
class LumperEndPoint{

    public $verb;
    public $args;
    public $request;
    public $lumper;
    public $returnVal;
    private $lumper_id;

    public function __construct($verb,$args = null, $request = null)
    {
        $this->verb = $verb;
        $this->args = $args;
        $this->lumper_id = $this->args[0];
        $this->request = $request;
        $this->lumper = new Lumper($this->lumper_id);
        $this->switchVerb();
    }
    private function switchVerb(){
        switch ($this->verb){
            case "get":
                $this->getWhat();
                break;
            case "create":
                $this->lumper->setFields($this->request)->create();
                $this->returnVal = $this->lumper;
                break;
            case "update":
                $this->lumper->setFields($this->request)->update();
                $this->returnVal = $this->lumper;
                break;
            default:
                throw new Exception('Unsupported Verb');
        }
        return $this;
    }
    private function getWhat(){
        if(count($this->args) <= 1){
            $this->returnVal = $this->lumper;
        }else{
            switch($this->args[1]){
                default:
                    throw new Exception('Unsupported Argument');
            }
        }
        return $this;
    }
}
class DispatchEndPoint{

    public $verb;
    public $args;
    public $request;
    public $dispatcher;
    public $returnVal;
    private $id;

    public function __construct($verb,$args = null, $request = null)
    {
        $this->verb = $verb;
        $this->args = $args;
        $this->request = $request;
        $this->id = $this->args[0];
        $this->dispatcher = new Dispatcher($this->id);
        $this->switchVerb();
    }
    private function switchVerb(){
        switch($this->verb){
            case "get":
                $this->getWhat();
                break;
            case "create":
                $this->dispatcher->setFields($this->request)->create();
                $this->returnVal = $this->dispatcher;
                break;
            case "update":
                $this->dispatcher->setFields($this->request)->update();
                $this->returnVal = $this->dispatcher;
                break;
            default:
                throw new Exception('Unsupported Verb');
        }
        return $this;
    }
    private function getWhat(){
        if(count($this->args) <= 1){
            $this->returnVal = $this->dispatcher;
        }else{
            switch($this->args[1]){
                default:
                    throw new Exception('Unsupported Argument');
            }
        }
        return $this;
    }
}
class ContactEndPoint{

    public $verb;
    public $args;
    public $request;
    public $contact;
    public $returnVal;
    private $id;

    public function __construct($verb,$args = null, $request = null)
    {
        $this->verb = $verb;
        $this->args = $args;
        $this->id = $this->args[0];
        $this->request = $request;
        $this->contact = new Contact($this->id);
        $this->switchVerb();
    }
    private function switchVerb(){
        switch($this->verb){
            case "get":
                $this->getWhat();
                break;
            case "create":
                $this->contact->setFields($this->request)->create();
                $this->returnVal = $this->contact;
                break;
            case "update":
                $this->contact->setFields($this->request)->update();
                $this->returnVal = $this->contact;
                break;
            default:
                throw new Exception('Unsupported Verb');
        }
        return $this;
    }
    private function getWhat(){
        if(count($this->args) <= 1){
            $this->returnVal = $this->contact;
        }else{
            switch($this->args[1]){
                default:
                    throw new Exception('Unsupported Argument');
            }
        }
        return $this;
    }
}
class UtilityEndPoint{

    public $verb;
    public $args;
    public $request;
    public $returnVal;
    private $id;

    public function __construct($verb,$args = null, $request = null)
    {
        $this->verb = $verb;
        $this->args = $args;
        $this->request = $request;
        $this->switchVerb();
    }
    private function switchVerb(){
        switch($this->verb){
            case "get":
                $this->getWhat();
                break;
            case "put":
                $this->putWhat();
                break;
            default:
                throw new Exception('Unsupported Verb');
        }
        return $this;
    }
    private function getWhat(){
        switch ($this->args[0]){
            case "gblocs":
                $this->returnVal = Utilities::getGlocList();
                break;
            case "areas":
                $this->returnVal = Utilities::getGblocAreas($this->args[1]);
                break;
            case "type_blackout":
                $this->returnVal = Utilities::getBlackOutTypes();
                break;
            case "basename":
                $this->returnVal = Utilities::getBaseName($this->args[1],$this->args[2]);
                break;
            case "invoiceCodes":
                $this->returnVal = Utilities::getInvoiceLineItemCodes();
                break;
            case "isUploadPending":
                $url = "http://ms-websuse-2/classes/dc/pendingUpload.php?gbl=" . $this->args[1];
                $this->returnVal = file_get_contents($url);
                break;
            default:
                throw new Exception('Unsupported Argument');
        }
        return $this;
    }
    private function putWhat(){
        switch ($this->args[0]){
            case "ACH":
                //$this->returnVal = $this->request;
                $this->returnVal = Utilities::updateACHInfo($this->request->vendorId,$this->request->accountNum,$this->request->routingNum);
                break;
            default:
                throw new Exception('Unsupported Argument');
        }
        return $this;
    }
}
class AuthEndPoint{

    public $verb;
    public $args;
    public $request;
    public $returnVal;

    public function __construct($verb,$args = null, $request = null)
    {
        $this->verb = $verb;
        $this->args = $args;
        $this->request = $request;
        $this->switchVerb();
    }
    private function switchVerb(){
        switch($this->verb){
            case "get":
                $this->getWhat();
                break;
            case "authenticate":
                $this->authWhat();
                break;
            case "add":
                $user = new WebUser();
                $user->setFields($this->request)->create();
                $this->returnVal = $user;
                break;
            case "update":
                $user = new WebUser($this->request->id);
                $user->setFields($this->request)->update();
                $this->returnVal = $user;
                break;
            default:
                throw new Exception('Unsupported Verb');
        }
        return $this;
    }
    private function getWhat(){
        switch ($this->args[0]){
            case "example":
                break;
            default:
                throw new Exception('Unsupported Argument');
        }
        return $this;
    }
    private function authWhat(){
        switch ($this->args[0]){
            case "epay":
                $a = new Authenticator($this->request->username,$this->request->password,$this->request->agentId,true);
                $this->returnVal = $a->user;
                break;
            case "employee":
                $a = new Authenticator($this->request->username,$this->request->password,false);
                $this->returnVal = $a->user;
                break;
            default:
                throw new Exception('Unsupported Argument');
        }
    }
}
class TonnageEndPoint{

    public $verb;
    public $args;
    public $request;
    public $returnVal;

    public function __construct($verb,$args = null, $request = null)
    {
        $this->verb = $verb;
        $this->args = $args;
        $this->request = $request;
        $this->switchVerb();
    }
    private function switchVerb(){
        switch($this->verb){
            case "get":
                if(!isset($this->args[0])){
                    $list = new TonnageList();
                    $this->returnVal = $list->shipments;
                }elseif(!(int)$this->args[0]){
                    throw new Exception('Invalid Tonnage ID');
                }else{
                    $this->returnVal = new TonnageShipment($this->args[0]);
                }
                break;
            case "request":
                $request = new TonnageRequest($this->request->user,$this->request->loads);
                $this->returnVal = $this->request;
                break;
            case "ua":
                $this->returnVal = $this->request;
//                $this->returnVal = getallheaders();
                break;
            case "search":
                try{
                    $s = new TonnageSearch($this->request->key,$this->request->values);
                    $this->returnVal = $s->search();
                }catch(Exception $e){
                    $this->returnVal = array();
//                    $this->returnVal = $e->getMessage();
                }
                break;
            case "nearOrigin":
                try{
                    $ref = new TonnageRef($this->args[0]);
                    $this->returnVal = (count($ref->near_origin) && $ref->near_origin[0] != '') ? $ref->buildShipments($ref->near_origin) : array();
                }catch(Exception $e){
                    $this->returnVal = array();
//                    $this->returnVal = $e->getMessage();
                }
                break;
            case "nearDest":
                try{
                    $ref = new TonnageRef($this->args[0]);
                    $this->returnVal = (count($ref->near_destination) && $ref->near_destination[0] != '') ? $ref->buildShipments($ref->near_destination) : array();
                }catch(Exception $e){
                    $this->returnVal = array();
//                    $this->returnVal = $e->getMessage();
                }
                break;
            case "ontheway":
                try{
                    $ref = new TonnageRef($this->args[0]);
                    $this->returnVal = (count($ref->on_the_way) && $ref->on_the_way[0] != '') ? $ref->buildShipments($ref->on_the_way) : array();
                }catch(Exception $e){
                    $this->returnVal = array();
//                    $this->returnVal = $e->getMessage();
                }
                break;
            case "asap":
                $shipment = new TonnageShipment($this->args[0]);
                $shipment->isAsap = $shipment->isAsap ? 0 : 1;
                $shipment->update();
                $this->returnVal = $shipment;
                break;
            default:
                throw new Exception('Unsupported Verb');
        }
        return $this;
    }
    private function getWhat(){
        switch ($this->args[0]){
            case "example":
                break;
            default:
                throw new Exception('Unsupported Argument');
        }
        return $this;
    }
}
class InvoiceEndPoint{

    const GBLPAT = "/[A-Z]{4}[0-9]{7}/i";

    public $verb;
    public $args;
    public $request;
    public $returnVal;

    public function __construct($verb,$args = null, $request = null)
    {
        $this->verb = $verb;
        $this->args = $args;
        $this->request = $request;
        $this->switchVerb();
    }
    private function switchVerb(){
        switch($this->verb){
            case "get":
                $this->getWhat();
                break;
            case "create":
                $i = new LineItem();
                $i->status_id = 1;
                $i->setFields($this->request)->create();
                $this->returnVal = $i;
                break;
            case "update":
                $i = new Invoice($this->args[0],$this->args[1]);
                $i->writePdf();
                $i->copyToBucket();
                $this->returnVal = $i;
                break;
            case "exists":
                $this->returnVal = Invoice::invoiceExists($this->args[0],$this->args[1]);
                break;
            case "delete":
               $this->returnVal = Invoice::delete($this->request->gbl_dps,$this->request->agent_id);
                break;
            default:
                throw new Exception('Unsupported Verb');
        }
        return $this;
    }
    private function getWhat(){
        if(preg_match(self::GBLPAT,$this->args[0])){
            $i = new Invoice($this->args[0],$this->args[1]);
            $this->returnVal = $i->lineItems;
        }elseif((int)$this->args[0]){
            $this->returnVal = new LineItem($this->args[0]);
        }else{
            switch ($this->args[0]){
                case "codes":
                    $this->returnVal = "";
                    break;
                case "pdf":
                    $i = new Invoice($this->args[1],$this->args[2]);
                    $i->writePdf();
                    $this->returnVal = $i->webPath;
                    break;
                case "preview":
                    $i = new Invoice($this->args[1],$this->args[2]);
                    $i->writePdf();
                    $this->returnVal = $i->webPath;
                    Invoice::delete($this->args[1],$this->args[2]);
                    break;
                default:
                    throw new Exception('Unsupported Argument');
            }
        }
        return $this;
    }
}
