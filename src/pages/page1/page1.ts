import { Component } from '@angular/core';
import { UserApi } from './../shared/user-api.service';


import { ModalController, ViewController, NavController, NavParams } from 'ionic-angular';

@Component({
  selector: 'page-page1',
  templateUrl: 'page1.html'
})
export class Page1 {

  receipt: any;
  receiptImage: any;


  constructor(public navCtrl: NavController, public navParams: NavParams, public userApi: UserApi) {
    this.receipt = navParams.get('receipt');
    this.receiptImage = 'https://capstone.td9175.com/ci/application/receipts/' + this.receipt.image;
    console.log('Page1 loaded');
  }

  dismiss() {
   this.navCtrl.pop();
 }

}
