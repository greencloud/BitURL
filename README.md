# BitURL
BitURL is a simple Free URL shortener written in PHP. 

## HOW TO USE THIS PROGRAM

Requirements: This program uses Codeigniter 3.1.11

1. Download and extract BitURL-Setup-v.1.0.zip

2. Copy all the essential files in the **application** folder
   to their designated folders in your Codeigniter application
   folder.

3. Setup your database connection properly and install the
   '**setup/biturl_data.sql**' file in your MySQL database.

4. Copy '**setup/htaccess.txt**' file in your root or public_html
   directory and rename it to '**.htaccess**'

5. This API can be integrated into another web application by
   simply using the simple, readily to use function in the
   '**setup/API.php**' file. Enjoy!

###### --------------------------------

**Any URL can be formatted by appending it to the API URL:**

https://xzample.cc/biturl/api?url=[YOUR_LONG_URL]

      Sample API Application:
      https://xzample.cc/biturl/api?url=http://www.example.com/somelongurlquery?foo=bar

**The format of the output URL will be something like this:**

https://xzample.cc/aBc3Mx
