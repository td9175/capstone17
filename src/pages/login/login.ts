import { HomePage } from './../home/home';
import { AccountsPage } from './../accounts/accounts';
import { MyVaultPage } from './../my-vault/my-vault';
import { Component } from '@angular/core';
import { NavController, NavParams } from 'ionic-angular';
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

  constructor(public navCtrl: NavController, public navParams: NavParams, public authService: AuthService, public user: User, public userGlobals: UserGlobals) { }

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

  enrollNow(){
    this.navCtrl.push(MyVaultPage);
  }

  loginForm(form: NgForm) {
    if(this.authService.appLogin(form.value.email, form.value.password) === "") {
      console.log("Couldn't log you in. Bad username or password, or you didn't fill in the fields.");
    } else if(this.userGlobals.getGlobalSession() === "") {
      console.log("Couldn't start your session or store your token.");
    }
    else {
      console.log("We got a session token for you. Redirect or something");
    }
  };

}
