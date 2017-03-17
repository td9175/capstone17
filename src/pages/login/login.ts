import { HomePage } from './../home/home';
import { AccountsPage } from './../accounts/accounts';
import { Component } from '@angular/core';
import { NavController, NavParams } from 'ionic-angular';

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

  constructor(public navCtrl: NavController, public navParams: NavParams) {}

  // Test console log below, should be deleted in further versions.
  ionViewDidLoad() {
    console.log('ionViewDidLoad LoginPage');
    console.log('sami is here');
    // added cheeky response here.
<<<<<<< HEAD
    console.log('interesting use of console logs sami');
=======
    console.log('interesting use of console logs sami')
>>>>>>> master
  }

  goToHome(){
    // this.navCtrl.push(AccountsPage);
    this.navCtrl.popToRoot();
  }

}
