import { Component } from '@angular/core';
import { UserApi } from './../shared/user-api.service';


import { ModalController, ViewController, NavController, NavParams } from 'ionic-angular';

@Component({
  selector: 'page-page1',
  templateUrl: 'page1.html'
})
export class Page1 {

  public receiptTitle: any;

  constructor(public navCtrl: NavController, public userApi: UserApi) {
    this.receiptTitle = this.userApi.getSpecificReceiptImage;
    this.helloTest();
  }

  helloTest(){
    console.log('Loaded receiptImagePage. ReceiptTitle: ', this.receiptTitle);
  }

  dismiss() {
   this.navCtrl.pop();
 }

}
