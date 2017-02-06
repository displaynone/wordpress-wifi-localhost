# Localhost WIFI access

Want to test your responsive theme in localhost in your mobile device? When you are developing in localhost is hard to test in your smart phone or tablet. This WordPress plugin helps you to access to your localhost web server through your LAN

## Instalation

* Download, install and active the plugin
* Access to settings page *Tools > WIFI Access* and set your LAN mask (usually **192.168.1.**)
* Modify your Apache Virtual Hosts configuration file for granting access:

```
<VirtualHost *192.168.1.NNN*>
    ServerAdmin *192.168.1.NNN*
    DocumentRoot "*path_to_your_htdocs*"
    ServerName *192.168.1.NNN*
    LogLevel debug
    ErrorLog "logs/wordpress-error.log"
    CustomLog "logs/wordpress-access.log" combined
</VirtualHost>
```

More information in the [original post in Sentido Web](http://sentidoweb.com/2015/03/12/acceder-a-wordpress-en-localhost-desde-tu-red-wifi.php) (in Spanish) 