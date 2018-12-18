<?php

require_once __DIR__ . '/api.php';

/*PROD*/
require_once __DIR__ . '/../../classes/milship_core/models/ops/Shipment.php';
require_once __DIR__ . '/../../classes/milship_core/models/ops/Agent.php';
require_once __DIR__ . '/../../classes/milship_core/models/ops/Contact.php';
require_once __DIR__ . '/../../classes/milship_core/models/ops/Driver.php';
require_once __DIR__ . '/../../classes/milship_core/models/ops/Lumper.php';
require_once __DIR__ . '/../../classes/milship_core/models/ops/Dispatcher.php';
require_once __DIR__ . '/../../classes/milship_core/models/billing/Vendor.php';
require_once __DIR__ . '/../../classes/ms_core/models/ops/tonnage/TonnageShipment.php';
require_once __DIR__ . '/../../classes/ms_core/models/ops/tonnage/TonnageList.php';
require_once __DIR__ . '/../../classes/milship_core/processes/traffic/AgentLoad.php';
require_once __DIR__ . '/../../classes/milship_core/processes/traffic/VanOperator.php';

/*DEV*/
// require_once __DIR__ . '/../ms_core/models/ops/Shipment.php';
// require_once __DIR__ . '/../ms_core/models/ops/Agent.php';
// require_once __DIR__ . '/../ms_core/models/ops/Contact.php';
// require_once __DIR__ . '/../ms_core/models/ops/Driver.php';
// require_once __DIR__ . '/../ms_core/models/ops/Lumper.php';
// require_once __DIR__ . '/../ms_core/models/ops/Dispatcher.php';
// require_once __DIR__ . '/../ms_core/models/billing/Vendor.php';
// require_once __DIR__ . '/../ms_core/models/ops/tonnage/TonnageShipment.php';
// require_once __DIR__ . '/../ms_core/models/ops/tonnage/TonnageList.php';
//
// require_once __DIR__ . '/../ms_core/processes/traffic/AgentLoad.php';
// require_once __DIR__ . '/../ms_core/processes/traffic/VanOperator.php';

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
      $data = $this->_parseDriverArgs();
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
      $data = new Lumper($this->verb);
    }elseif($this->method == 'GET' && !isset($this->verb)){
      //get all
      $data = Lumper::get('status_id',1);
    }elseif($this->method == 'GET' && isset($this->verb) && count($this->args)){
      //get with args
      throw new \Exception('No arg support');
    }elseif($this->method == 'POST' && !isset($this->verb)){
      //create
      throw new \Exception('Cannot POST here.');
    }elseif($this->method == 'PUT' && isset($this->verb)){
      //update
      $data = new Lumper($this->verb);
      $data->setFields($this->file)->update();
    }else{
      throw new \Exception('Unsupported request');
    }
    return $data;
  }
  protected function dispatch(){
    $data = null;
    if($this->method == 'GET' && count($this->args)){
      //get specific
      $data = new Dispatcher($this->args[0]);
    }elseif($this->method == 'GET' && !isset($this->verb) && !count($this->args)){
      //get all
      $data = Dispatcher::get("status_id",1);
    }elseif($this->method == 'POST' && !isset($this->verb)){
      //create
      throw new \Exception('Cannot POST here.');
    }elseif($this->method == 'PUT' && isset($this->verb)){
      //update
      $data = new Dispatcher($this->args[0]);
      $data->setFields($this->file)->update();
    }else{
      throw new \Exception('Unsupported request');
    }
    return $data;
  }
  protected function vendor(){
    $data = null;
    if($this->method == 'GET' && count($this->args)){
      //get specific
      $data = new Vendor($this->args[0]);
    }elseif($this->method == 'GET' && !isset($this->verb) && !count($this->args)){
      //get all
      $data = Vendor::get("status_id",1);
    }elseif($this->method == 'POST' && !isset($this->verb)){
      //create
      throw new \Exception('Cannot POST here.');
    }elseif($this->method == 'PUT' && isset($this->verb)){
      //update
      $data = new Vendor($this->args[0]);
      $data->setFields($this->file)->update();
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
      $data = new Contact($this->args[0]);
      $data->setFields($this->file)->update();
    }else{
      throw new \Exception('Unsupported request');
    }
    return $data;
  }
  protected function traffic(){
    $data = null;
    if($this->method == 'GET'){
      throw new \Exception('Cannot GET here.');
    }elseif($this->method == 'PUT'){
      throw new \Exception('Cannot PUT here.');
    }elseif($this->method == 'POST' && !isset($this->verb)){
      throw new \Exception('No Process Specified.');
    }else{
      $data = $this->_parseTrafficVerb();
    }
    return $data;
  }
  protected function tonnage(){
    $data = null;
    if(!isset($this->verb) && !isset($this->args[0]) && $this->method == 'POST'){ //create
        throw new \Exception('POSTING is not allowed.');
    }elseif(!isset($this->verb) && !isset($this->args[0]) && $this->method == 'GET'){ //get all
        $list = new TonnageList();
        $shipments = array();
        foreach($list->shipments as $possible){
          if(strtotime($possible->pickup) < strtotime('15 Jan 2019')){
            $shipments[] = $possible;
          }
        }
        $data = $shipments;
    }elseif(!isset($this->verb) &&(int)$this->args[0] && $this->method == 'GET'){ //get by id
        $data = new TonnageShipment($this->args[0]);
    }elseif((int)$this->args[0] && $this->method == 'PUT'){ //update by id
        throw new \Exception('Update currently not allowed.');
    }elseif(isset($this->verb)){
        $data = $this->_parseTonnageArgs();
    }else{
        throw new \Exception('Malformed Request');
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
      case "militaryhousing":
        $data = $shipment->isMilitaryHousing($this->args[1]);
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
    $driver = new Driver($this->verb);
    switch(strtolower($this->args[0])){
      case "notifications":
        $data = $driver->getNotifications();
      break;
      case "responses":
        $data = $driver->getResponses();
      break;
      case "labor":
        $data = $driver->getLumpers();
      break;
      case "shipments":
        $data = $driver->getshipments($this->args[1]);
      break;
      case "settlements":
        $data = $driver->getSettlements();
      break;
      case "dispatchers":
        $data = $driver->getDispatchers();
      break;
      default:
        throw new \Exception('Invalid Argument');
    }
    return $data;
  }
  protected function _parseTrafficVerb(){
    $data = null;
    switch(strtolower($this->verb)){
      case "agentload":
        $proc = new AgentLoad($this->args[0],$this->request->at_agent_eta_early,$this->request->at_agent_eta_late,$this->request->load_eta_early_time,$this->request->load_eta_late_time);
        $data = $proc->response;
      break;
      case "vanoperator":
        $proc = new VanOperator($this->args[0],$this->request);
        $data = $proc->response;
      break;
      default:
        throw new \Exception('Invalid Argument');
    }
    return $data;
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
