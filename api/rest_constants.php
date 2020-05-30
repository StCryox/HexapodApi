<?php
	class Rest {
		const HTTP  = 'http';
		const HTTPS = 'https';
		
		const POST   = 'POST';
		const GET    = 'GET';
		const PUT    = 'PUT';
		const DELETE = 'DELETE';
		
		const HTTP_OK = 200;
		const HTTP_CREATED = 201;
		const HTTP_ACCEPTED = 202;
		const NOT_MODIFIED = 304; 
		const BAD_REQUEST = 400; 
		const NOT_FOUND = 404; 
		const NOT_ALOWED = 405; 
		const CONFLICT = 409; 
		const PRECONDITION_FAILED = 412; 
		const INTERNAL_ERROR = 500; 
	}
?>