# BitURL
BitURL is a simple Free URL shortener written in PHP. 

-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
: HOW TO USE THIS PROGRAM
-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-

Requirements: This program uses Codeigniter 3.1.11

1. Download and extract BitURL-Setup-v.1.0.zip

2. Copy all the essential files in the 'application' folder
   to their designated folders in your Codeigniter application
   folder

3. Properly setup your database connection and install the
   'setup/biturl_data.sql' file in your database

4. Copy 'setup/htaccess.txt' filen in your root directory and
   rename it to '.htaccess'

5. This program can be used in another web application by
   simply using a simple readily to use function in the
   'setup/API.php' file. Enjoy!

--------

Any long URL can be formatted by appending it to the API URL:
	https://xzample.cc/biturl/api?url=[YOUR_LONG_URL]

	Example:
	https://xzample.cc/biturl/api?url=http://www.example.com/somelongurlquery?foo=bar

The output URL will be in this format:
	https://xzample.cc/aBc3Mx
