# capstone17
2017 capstone project.

## Current Dev Readme

Ionic and backand setup: [ionic](http://www.ionicframework.com) and [backand](http://www.backand.com).
**NOTE: Ionic current development using version ^2.2.1**

### For the team:

- Firstly, I recommend checking the Ionic 2 setup documentation, it's really simple, but useful.

- Setting up Ionic on your machine:
```bash
$ npm install -g ionic cordova
```

- Make sure to navigate into the root folder of the app. 

- Install dependencies for backand
```bash
$ npm i -S @backand/angular2-sdk socket.io-client @types/node @types/socket.io-client
```

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

## Setting up your own Backand application

- Want to customize data model or change authorization?
- Change the app's parameters (/src/app/app.component.ts) in the init function with your new app parameters:
```javascript
this.backand.init({
  appName: 'your app name',
  signUpToken: 'your signup token',
  anonymousToken: 'your anonymousToken token',
  runSocket: true,
  mobilePlatform: 'ionic'
});
```

- Message from Backand: 
you may want to review the full API of our [angular2-sdk](https://github.com/backand/angular2-sdk).

- Credits
Backand setup guide and readme.md design thanks to: [Yoram Kornatzky](https://market.ionic.io/starters/ionic-2-backand-starter)
