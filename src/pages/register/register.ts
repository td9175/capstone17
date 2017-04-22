import { LoginPage } from './../login/login';
import { AccountsPage } from './../accounts/accounts';
import { MyVaultPage } from './../my-vault/my-vault';
import { Component } from '@angular/core';
import { NavController, NavParams, LoadingController } from 'ionic-angular';
import { UserApi, User, AuthService, UserGlobals } from './../shared/user-api.service';
import { NgForm } from '@angular/forms/src/directives';
import { RegisterModel } from './../../models/register.model';

@Component({
  selector: 'page-register',
  templateUrl: 'register.html'
})
export class RegisterPage {

  model = new RegisterModel("", "", "", "");

  constructor(public navCtrl: NavController, public navParams: NavParams, public authService: AuthService, public user: User, public userGlobals: UserGlobals, public loadingController: LoadingController) { }

  // Test console log below, should be deleted in further versions.
  ionViewDidLoad() {
    console.log('ionViewDidLoad RegisterPage');
  }

  register = {
    fname: '',
    lname: '',
    email: '',
    password: ''
  };

  registerForm(form: NgForm) {

    let loader = this.loadingController.create({
      content: 'Signing you up...',
    });
    loader.present();
    this.authService.appRegister(form.value.email, form.value.password, form.value.fname, form.value.lname);

    function sleep (time) {
      return new Promise((resolve) => setTimeout(resolve, time));
    }

    sleep(1600).then(() => {
      if(this.userGlobals.getDidRegister()) {
        loader.dismissAll();
        console.log("user did register, yay");
        //this.toast.show("Successfully logged in! Redirecting you now...", "1800", "bottom");
        this.navCtrl.push(LoginPage);
      }
      else {
        loader.dismissAll();
        //this.toast.show("Invalid username or password.", "1800", "center");
        console.log("Login error.");
      }
    }, err => {
      loader.dismissAll();
      //this.toast.show("Invalid username or password.", "1800", "center");
      console.log("err: ", err);
    });
  }

}
