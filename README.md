# MyZPL

## Send ZPL code to Zebra printers using sockets

<p>
   
</p>  

<p>Zebra printers allows printing from web interface, simply connects to the Zebra Printer using sockets.</p>
  
 **IP ADDRESS:**
  <p>Set and Validate the Zebra IP Address with set_and_validate_IP($IP_Address) before to send information.</p>
  
 **PORT NUMBER:**
  <p>Zebra printers by default use 9100 port and you can change it by using set_Port($port) </p>
  
 **ZPL CODE:**
  <p>Test ZPL representation for Zebra is added in function test_ZPL().</p>
  <p>It is better Zebra tools to create ZPL templates and labels</p>
  
  but we can use ZPL online viewer [LABELARY](https://www.labelary.com/viewer.html) 
  for a visual representation.
  <p> </p>
  
<hl>
  <p align="center">
      <h2>How to use MyZPL</h2>
  </p> 
<hl>
  
<p>
  Start with using IP Address and change the Port number if you need it, set the ZPL code and send it to Zebra printer.
</p>  

<p>
  **Easy !!!**
</p>  


<pre>
/*
*	Test MyZPL class
*/

$IP_Address = "192.168.1.10";

//Start class using Zebra IP Address 
$zpl = new MyZPL($IP_Address);

//Change port if it is needed 
//$port = "9100";
//$zpl->set_Port($port)

//create a ZPL Test code
$zpl->test_ZPL();

//or you can set zpl code 
//$zpl_code = "zpl code template";
//$zpl->set_ZPL($zpl_code);

//send information to Zebra Printer
$zpl->send_ZPL();

</pre>
  
  <p>
   
  </p>
  
  
  ##GNU GENERAL PUBLIC LICENSE
  <p></p>
  
  Created by: 	**Hector Manuel Alonso Ortiz**
  <p></p>
  
  eMail: 		**[alonso.hector@gmail.com](mailto:alonso.hector@gmail.com)**
  <p></p>
  
  Github: 		**https://github.com/alonsohector/MyZPL**
  <p></p>
  



