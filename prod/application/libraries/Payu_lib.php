<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 
/**
 * Code Igniter
 * @package		CodeIgniter
 * @author		Sahaya Jeswin
 * @filesource
 */

// ------------------------------------------------------------------------

/* Payu_Lib Controller Class*/

// ------------------------------------------------------------------------

class payu_lib {
	var $fields = array();		// array holds the fields to submit to paypal
	var $action= 'https://secure.payu.in/_payment';// End point - change to https://secure.payu.in for LIVE mode
	
	//var $action = 'https://test.payu.in';//test
	
	var $CI;
	function paypal_lib()
	{
		$this->CI =& get_instance();
		$this->CI->load->helper('url');
		$this->CI->load->helper('form');
		$this->CI->load->config('paypallib_config');
	}	
	
	function add_field($field, $value) 
	{
		// adds a key=>value pair to the fields array, which is what will be 
		// sent to paypal as POST variables.  If the value is already in the 
		// array, it will be overwritten.
		$this->fields[$field] = $value;
	}

	function payu_auto_form() 
	{
		// this function actually generates an entire HTML page consisting of
		// a form with hidden elements which is submitted to Payumoney via the 
		// BODY element's onLoad attribute.

		echo '<html>' . "\n";
		echo '<head><title>Processing Payment...</title></head>' . "\n";
		echo '<body style="text-align:center;" onLoad="document.forms[\'payuForm\'].submit();">' . "\n";
		echo '<p style="text-align:center;">Please wait, your order is being processed and you will be redirected to the Payumoney Website.</p>' . "\n";
		echo $this->payu_form('payuForm');
		echo '</body></html>';
	}

	function payu_form($form_name='payu_form') 
	{
		$action= 'https://secure.payu.in/_payment';
		$str = '';
		$str .= '<form method="post" action="'.$action.'" name="'.$form_name.'"/>' . "\n";
		foreach ($this->fields as $name => $value)
			$str .= form_hidden($name, $value) . "\n";
		$str .= '<p> <input type="submit" hidden name="add"  border="0" /> </p>';
		$str .= form_close() . "\n";

		return $str;
	}
}

?>
