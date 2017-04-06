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

  receipts: any

  constructor(public navCtrl: NavController, public navParams: NavParams) {
    this.receipts = [
      {
        receiptsId: 1,
        title: 'April 04, 2017 @ 4:54p.m.',
        amount: '$4.99'
      },
      {
        receiptsId: 2,
        title: 'April 06, 2017 @ 1:54p.m.',
        amount: '$1.59'
      },
      {
        receiptsId: 3,
        title: 'April 03, 2017 @ 2:54p.m.',
        amount: '$5.79'
      }
    ];
  }

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
