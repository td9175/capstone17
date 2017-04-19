import { platformBrowserDynamic } from '@angular/platform-browser-dynamic';
import { Component } from '@angular/core';
import { NavController, NavParams } from 'ionic-angular';

/*
  Generated class for the AccountDetail page.

  See http://ionicframework.com/docs/v2/components/#navigation for more info on
  Ionic pages and navigation.
*/
@Component({
  selector: 'page-account-detail',
  templateUrl: 'account-detail.html'
})
export class AccountDetailPage {

  accountType: any;
  transactions: any;

  constructor(public navCtrl: NavController, public navParams: NavParams) {}

  ionViewDidLoad() {
    console.log('ionViewDidLoad AccountDetailPage');
    this.accountType = "HSA"
    var A={A:0,B:1,C:2}
    var B={D:3,E:4,F:5}
    this.transactions.push(A);
    this.transactions.push(B);
  }

  goBack() {
    this.navCtrl.pop();
  }

}
