import { AccountsPage } from './../accounts/accounts';
import { Component } from '@angular/core';
import { NavController, NavParams } from 'ionic-angular';

/*
  Generated class for the MyVault page.

  See http://ionicframework.com/docs/v2/components/#navigation for more info on
  Ionic pages and navigation.
*/
@Component({
  selector: 'page-my-vault',
  templateUrl: 'my-vault.html'
})
export class MyVaultPage {

  constructor(public navCtrl: NavController, public navParams: NavParams) {}

  ionViewDidLoad() {
    console.log('ionViewDidLoad MyVaultPage');
  }

  goBack() {
    this.navCtrl.pop();
  }

  loadReciept(){
    this.navCtrl.push(AccountsPage);
  }

}
