<!-- HTML for the button -->
<table>
     <tr>
      <td><p>Valid AppID</p></td>
    </tr>
    <tr>
        <td><button id="createAccountBtn">Create Account with [App]</button></td>
    </tr>
  
      <tr>
      <td><p><div id="output"></div></p></td>
    </tr>
    
    
    
</table>
<?php
   $bytes = random_bytes(20);
   $transId=bin2hex($bytes);
?>
<script>
document.getElementById('createAccountBtn').addEventListener('click', function() {
    // Replace these placeholders with your actual values
    const platformAuthUrl = 'https://blinkapp.ecomsoft.co.in/customerapi/account/customlogin/';
    const clientId = 'qukoylsn4p9sewj7x6xh1kumgm43ctld';
    const redirectUri = 'https://dev.ecomsoft.co.in/LoginShare/data.php';
    const transId ='<?=$transId?>' ; 

    // Construct the authentication URL
    const authUrl = `${platformAuthUrl}?client_id=${clientId}&redirect_uri=${redirectUri}&response_code=${transId}`;

    // Open a popup window
    const width = 600;
    const height = 400;
    const left = window.innerWidth / 2 - width / 2;
    const top = window.innerHeight / 2 - height / 2;

    const popup = window.open(authUrl, 'AuthPopup', `width=${width},height=${height},left=${left},top=${top}`);

    // Check for popup window closing
    const checkPopupClosed = setInterval(() => {
        if (popup.closed) {
            clearInterval(checkPopupClosed);
            
            //alert('You cancelled the operation!!');
          //  location.reload();
          
          
          const output = document.getElementById("output");

// Create XHR object
var xhr = new XMLHttpRequest();

// Configure the request (substitute a URL
// to the file below)
xhr.open("GET", "<?=$transId?>.txt", false);

// Set up the callback for when the response has
// been recieved
xhr.onreadystatechange = function (){
 if(xhr.readyState === 4) {
   // Was the request successful?
   if(xhr.status === 200 || xhr.status == 0) {
     // Populate the <div> with the response text
     output.textContent = xhr.responseText;
   }
 }
}
xhr.send(null); 
          
          
            // Perform actions after the popup is closed, e.g., fetch user details or handle registration
            // You may need to communicate between the popup and the parent window using window.postMessage()
        }
    }, 1000); // Adjust the interval as needed
});
</script>