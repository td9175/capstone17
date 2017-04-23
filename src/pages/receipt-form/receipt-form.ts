import { Component } from '@angular/core';
import { NavController, NavParams } from 'ionic-angular';

/*
  Generated class for the ReceiptForm page.

  See http://ionicframework.com/docs/v2/components/#navigation for more info on
  Ionic pages and navigation.
*/
@Component({
  selector: 'page-receipt-form',
  templateUrl: 'receipt-form.html'
})
export class ReceiptFormPage {

  searchJson: any;

  constructor(public navCtrl: NavController, public navParams: NavParams) {
    this.searchJson = [
      {
        item: 'Product something',
        amount: '$4.99'
      },
      {
        item: 'Something Product',
        amount: '$2.59'
      },
      {
        item: 'This is Stupid',
        amount: '$4.36'
      },
      {
        item: 'Almost done with this shit!',
        amount: '$5.99'
      }
    ];
  }

  ionViewDidLoad() {
    console.log('ionViewDidLoad ReceiptFormPage');
  }

}
