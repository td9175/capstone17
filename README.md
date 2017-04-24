# capstone17
2017 capstone project.

## Team 12bit UMB Health App Installation Procedures

This guide assumes you have a working MySQL database on localhost:3306, a PHP 7 installation (with requisite plugins enabled for your web server of choice), and are running the web server for the app on localhost as well. The development database is ```umb```; username and password are in the ```/ci/application/config/database.php```.
Add the DDL in the ```/ddl``` folder to populate tables
```bash
mysql -u username -p umb < /ddl/ddl.sql
```
**NOTE: Ionic current development using version ^2.2.1**
- Clone git repository 
```bash
git clone https://github.com/td9175/capstone17.git
```
- Navigate to the repo
```bash
cd capstone17
```
- Install Node.js 
  Download: https://nodejs.org/en/download/
- Update npm to the latest version
```bash
sudo npm install npm@latest -g
```
- Install Ionic and Apache Cordova
```bash
sudo npm install -g ionic cordova
``` 
- Navigate to the root of where you downloaded capstone17
- Add Cordova Platforms
```bash
ionic platform add browser android ios
```
- Install Cordova plugins
```bash
ionic plugin add cordova-plugin-actionsheet cordova-plugin-camera cordova-plugin-compat cordova-plugin-console cordova-plugin-device cordova-plugin-file cordova-plugin-file-transfer cordova-plugin-filepath cordova-plugin-inappbrowser cordova-plugin-splashscreen cordova-plugin-statusbar cordova-plugin-whitelist cordova-plugin-x-toast ionic-plugin-keyboard
```
- Ensure Ionic is running correctly 
```bash
ionic info
```
- Check Ionic plugins
```bash
ionic plugin
```
- Check Ionic platforms
```bash
ionic platforms
```
- Running the app to test in browser (I recommend chrome)
```bash
ionic serve
```
- Build the app for your platform
  - Note: you will need Xcode installed and run the command on a Mac to build the iOS app locally, as well as the Java JDK + Android Studio to build for Android.
```bash
ionic build android
ionic build ios
ionic build browser
```
- To host the browser build, set the
```DocumentRoot``` to: ```/platforms/browser/www```
