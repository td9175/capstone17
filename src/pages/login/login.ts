import { HomePage } from './../home/home';
import { AccountsPage } from './../accounts/accounts';
import { MyVaultPage } from './../my-vault/my-vault';
import { Component } from '@angular/core';
import { NavController, NavParams } from 'ionic-angular';
import { UserApi, User, AuthService } from './../shared/user-api.service';

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

  constructor(public navCtrl: NavController, public navParams: NavParams, public authService: AuthService, public user: User) {}

  // Test console log below, should be deleted in further versions.
  ionViewDidLoad() {
    console.log('ionViewDidLoad LoginPage');
    console.log('sami is here');
    // added cheeky response here.
    console.log('interesting use of console logs sami');
  }

  loginFire(){
    //this.navCtrl.push(AccountsPage);
    //this.navCtrl.popToRoot();
    //this.navCtrl.push(HomePage);
    this.authService.appLogin(email, password);
  }

  enrollNow(){
    this.navCtrl.push(MyVaultPage);
  }

}
