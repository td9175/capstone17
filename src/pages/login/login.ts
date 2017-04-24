import { HomePage } from './../home/home';
import { RegisterPage } from './../register/register';
import { AccountsPage } from './../accounts/accounts';
import { MyVaultPage } from './../my-vault/my-vault';
import { Component } from '@angular/core';
import { NavController, NavParams, LoadingController } from 'ionic-angular';
import { UserApi, User, AuthService, UserGlobals } from './../shared/user-api.service';
import { NgForm } from '@angular/forms/src/directives';
import { LoginModel } from './../../models/login.model';
//import { Toast } from '@ionic-native/toast';

/*
  Generated class for the Login page.

  See http://ionicframework.com/docs/v2/components/#navigation for more info on
  Ionic pages and navigation.
*/

@Component({
  selector: 'page-login',
  templateUrl: 'login.html'
})


export class LoginPage {
  model = new LoginModel("", "");

  LoginStatus: any;
  
  constructor(public navCtrl: NavController, public navParams: NavParams, public authService: AuthService, public user: User, public userGlobals: UserGlobals, public loadingController: LoadingController) { }

  //Test console log below, should be deleted in further versions.
  ionViewDidLoad() {
    console.log('ionViewDidLoad LoginPage');
    console.log('interesting use of console logs sami');
  }

  login = {
    email: '',
    password: ''
  };

  enrollNow() {
    this.navCtrl.push(RegisterPage);
  }

  twelveBitDebug() {
    this.navCtrl.push(HomePage);
  }

  loginForm(form: NgForm) {

    let loader = this.loadingController.create({
      content: 'Logging in...',
    });
    loader.present();
    this.authService.appLogin(form.value.email, form.value.password);

    function sleep (time) {
      return new Promise((resolve) => setTimeout(resolve, time));
    }

    sleep(1600).then(() => {
      if(this.userGlobals.isLoggedIn()) {
        loader.dismissAll();
        console.log(this.userGlobals.getGlobalEmail());
        console.log(this.userGlobals.getGlobalSession());
        //this.toast.show("Successfully logged in! Redirecting you now...", "1800", "bottom");
        this.navCtrl.push(HomePage);
        this.LoginStatus = true;
        console.log("Login Status: ", this.LoginStatus)
      }
      else {
        loader.dismissAll();
        //this.toast.show("Invalid username or password.", "1800", "center");

        console.log("Login error.");
        this.LoginStatus = false;
        console.log("Login Status: ", this.LoginStatus)
      }
    }, err => {
      loader.dismissAll();
      //this.toast.show("Invalid username or password.", "1800", "center");
      console.log("err: ", err);
    });
  }

}
