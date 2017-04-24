# capstone17
2017 capstone project.

## Current Dev Readme

This guide assumes you have a working MySQL database on localhost:3306, a [CodeIgniter 3 installation](https://www.codeigniter.com/download) unzipped to ```DocumentRoot/ci/```, and are running the web server for the app on localhost as well. The development database is ```umb```; username and password are in the ```/ci/application/config/database.php```.

Add the DDL in the ```/ddl``` folder to populate tables
```mysql -u username -p umb < /ddl/ddl.sql```

Ionic setup: [ionic](http://www.ionicframework.com)
**NOTE: Ionic current development using version ^2.2.1**
- Clone git repository 
```git clone https://github.com/td9175/capstone17.git```

- Navigate to the repo
```cd capstone17```
- Install node.js 
  Download: https://nodejs.org/en/download/
- Update npm to the latest version
```sudo npm install npm@latest -g```
- Install ionic
```sudo npm install -g ionic cordova``` 
- Navigate to the root of where you downloaded capstone17
- Add Cordova Platforms
```ionic platform add browser android ios```
- Install cordova plugins
```ionic plugin add cordova-plugin-actionsheet cordova-plugin-camera cordova-plugin-compat cordova-plugin-console cordova-plugin-device cordova-plugin-file cordova-plugin-file-transfer cordova-plugin-filepath cordova-plugin-inappbrowser cordova-plugin-splashscreen cordova-plugin-statusbar cordova-plugin-whitelist cordova-plugin-x-toast ionic-plugin-keyboard```
- Check ionic info 
  ```ionic info```
- Check ionic plugins
```ionic plugin```
- Check ionic platforms
```ionic platforms```
- Running the app to test in browser (I recommend chrome)
```ionic serve```

- Build the app for your platform
```
ionic build android
ionic build ios
ionic build browser
```
Note: you will need Xcode installed and run the command on a Mac to build the iOS app locally, as well as the Java JDK + Android Studio to build for Android.

- To host the browser build, set the
```DocumentRoot``` to: ```/platforms/browser/www```

### For the team:
- Clone the git repository
```
git clone https://github.com/td9175/capstone17.git
```

- Make sure to update your npm to the latest version.
```bash
$ npm install npm@latest -g
```

- Install Ionic on your machine:
```bash
$ npm install -g ionic cordova
```

- Make sure to navigate into the root folder of the app. 

- Note: You may need to use sudo.

- Install Cordova Plugins
```bash
$ ionic plugin add cordova-plugin-inappbrowser
```

- Check ionic project:
```bash
$ ionic info
```

- Running the app to test in browser (I recommend chrome)
```bash
$ ionic serve
```
