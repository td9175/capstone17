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
              receipts : [
                        {id: 1, title: 'item 1'},
                        {id: 2, title: 'item 2'}
                      ]
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
