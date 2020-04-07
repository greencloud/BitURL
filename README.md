# C-URL
C-URL is a simple, forever Free open source, URL shortener web application written in PHP.

## HOW TO USE THIS WEB APPLICATION

**Prerequisite:** This web application requires Codeigniter 3.1.11

1. Clone or download the master file and save it somewhere in your localhost.

2. Copy all the essential files from the **application** folder and save them in
   their designated locations in your Codeigniter's application folders.

3. Create a MySQL database and import the '**setup/curltab_data.sql**'
   file in it.

4. Copy '**setup/htaccess.txt**' file in your root or public_html directory
   and change its name to **.htaccess**.

5. The API can be integrated into another web application. Please refer to the
   '**setup/API.php**' file for some easy additional instructions. Enjoy!

###### --------------------------------

**Any URL can be shortened by appending it to the API URL, like so:**

https://c-url.me/curlit/api?url=[SOME_LONG_URL_THAT_REQUIRES_SHORTENING]

      Sample API Application:
      https://c-url.me/curlit/api?url=http://www.example.com/somelongurlquery?foo=bar

**C-URL will return a shortened URL similar to this (only 23 characters long):**

https://c-url.me/aBc3Mx
