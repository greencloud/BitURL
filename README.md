# C-URL
C-URL is a Free simple URL shortener application written in PHP.

## HOW TO USE THIS PROGRAM

**Requirements:** This web application requires Codeigniter 3.1.11

1. Download the files in your desktop: $ git clone https://github.com/greencloud/C-URL.git

2. Copy all the essential files in the **application** folder
   to their designated folders in your Codeigniter application
   folder.

3. Setup your database connection properly and install the
   '**setup/biturl_data.sql**' file in your MySQL database.

4. Copy '**setup/htaccess.txt**' file in your root or public_html
   directory and rename it to **.htaccess**.

5. This API can be integrated into another web application by
   simply using a simple, ready to use function in the
   '**setup/API.php**' file. Enjoy!

###### --------------------------------

**Any URL can be formatted by appending it to the API URL:**

https://xzample.cc/biturl/api?url=[SOME_LONG_URL_THAT_REQUIRES_SHORTENING]

      Sample API Application:
      https://xzample.cc/biturl/api?url=http://www.example.com/somelongurlquery?foo=bar

**The format of the output URL will be something like this:**

https://xzample.cc/aBc3Mx
