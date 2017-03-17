# capstone17
2017 capstone project.

## Current Dev Readme

Ionic and backand setup: [ionic](http://www.ionicframework.com) and [backand](http://www.backand.com).
**NOTE: Ionic current development using version ^2.2.1**

### For the team:

- Firstly, I recommend checking the Ionic 2 setup documentation, it's really simple, but useful.
- You'll probably need to run sudo

- Make sure to update your npm to the latest version.
```bash
$ npm install npm@latest -g
```

- Install Ionic on your machine:
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
