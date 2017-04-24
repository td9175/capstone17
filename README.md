# capstone17
2017 capstone project.

## Current Dev Readme

Ionic setup: [ionic](http://www.ionicframework.com)
**NOTE: Ionic current development using version ^2.2.1**
- Clone git repository 
git clone https://github.com/td9175/capstone17.git

- Navigate to the repo
```cd capstone17```
- Install node.js 
  Download: https://nodejs.org/en/download/
- Make sure to update your npm to the latest version
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
```ionic build android
ionic build ios
ionic build browser```

- To host the browser build, set the ```DocumentRoot``` to: ```/platforms/browser/www```

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
