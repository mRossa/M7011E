class RequestData {

 private $request_vars;
 private $data;
 private $http_accept;
 private $method;

 public function __construct() {

    $this->request_vars = array();
    $this->data = '';
    $this->http_accept = (strpos($_SERVER['HTTP_ACCEPT'], 'jason')) ? 'json' : 'xml';
    $this->method = 'get';

 }

 public function setData($data) {

    $this->data = $data;

 }

 public function getData() { return $this->data; }

 public function setMethod($method) {

    $this->method = $method;

 }

 public function getMethod() { return $this->method; }

 public function setRequestVars($request_vars) {

    $this->request_vars = $request_vars;

 }

 public function getRequestVars() { return $this->request_vars; }

 public function getHttpAccept() { return $this->http_accept; }

}
