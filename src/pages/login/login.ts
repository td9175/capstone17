import { HomePage } from './../home/home';
import { AccountsPage } from './../accounts/accounts';
import { MyVaultPage } from './../my-vault/my-vault';
import { Component } from '@angular/core';
import { NavController, NavParams, LoadingController } from 'ionic-angular';
import { UserApi, User, AuthService, UserGlobals } from './../shared/user-api.service';
import { NgForm } from '@angular/forms/src/directives';
import { LoginModel } from './../../models/login.model';

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

  constructor(public navCtrl: NavController, public navParams: NavParams, public authService: AuthService, public user: User, public userGlobals: UserGlobals, public loadingController: LoadingController) { }

  // Test console log below, should be deleted in further versions.
  ionViewDidLoad() {
    console.log('ionViewDidLoad LoginPage');
    console.log('sami is here');
    // added cheeky response here.
    console.log('interesting use of console logs sami');
  }

  login = {
    email: '',
    password: ''
  };

  enrollNow() {
    this.navCtrl.push(MyVaultPage);
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

    sleep(1200).then(() => {
      loader.dismissAll();
      console.log(this.userGlobals.getGlobalEmail());
      console.log(this.userGlobals.getGlobalSession());
      //this.presentToast('Logged in and redirecting you now...');
    }, err => {
      loader.dismissAll();
      //this.presentToast('Invalid username or password.');
    });

    // if( === "") {
    //   console.log("Couldn't log you in. Bad username or password, or you didn't fill in the fields.");
    // }
    // else {
    //   console.log("We got a session token for you. Redirect or something");
    // }
  }

}
