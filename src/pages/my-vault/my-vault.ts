import { Page1 } from './../page1/page1';
import { AccountsPage } from './../accounts/accounts';
import { Component } from '@angular/core';
import { ModalController, ViewController, NavController, NavParams } from 'ionic-angular';
import { Camera } from '@ionic-native/camera';
//import { ReceiptPoster } from './../shared/receipt-post.service';
import { ActionSheet, ActionSheetOptions } from '@ionic-native/action-sheet'
import { ActionSheetController } from 'ionic-angular';
import { UserApi } from './../shared/user-api.service';

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

  receipts: any;

  filteredReceipts: any;

  constructor(public navCtrl: NavController, public navParams: NavParams, public camera: Camera, public actionSheet: ActionSheet, public userApi: UserApi) {
    this.receipts = [
      {
        receiptsId: 1,
        title: 'April 04, 2017 @ 4:54p.m.',
        amount: '$4.99',
        url: 'https://i.ytimg.com/vi/lt0WQ8JzLz4/maxresdefault.jpg'
      },
      {
        receiptsId: 2,
        title: 'April 06, 2017 @ 1:54p.m.',
        amount: '$1.59',
        url: 'https://s-media-cache-ak0.pinimg.com/236x/a2/34/89/a234898de7bb54fb4eac0b3f1c229746.jpg'
      },
      {
        receiptsId: 3,
        title: 'April 03, 2017 @ 2:54p.m.',
        amount: '$5.79',
        url: 'https://s-media-cache-ak0.pinimg.com/736x/d7/b1/d0/d7b1d0a193528a8d41d00a3a53c3bb63.jpg'
      },
      {
        receiptsId: 4,
        title: 'March 03, 2017 @ 2:54p.m.',
        amount: '$5.79',
        url: 'http://animal-dream.com/data_images/tiger/tiger8.jpg'
      }
    ];
  }

  ionViewDidLoad() {
    console.log('ionViewDidLoad MyVaultPage');
    this.filteredReceipts = this.receipts;
  }

  goBack() {
    this.navCtrl.pop();
  }

  loadReciept(){
    this.navCtrl.push(AccountsPage);
  }

  initializeItems(): void {
    this.filteredReceipts = this.receipts;
  }

  getReceipt(searchbar) {
    // Reset items back to all of the items
    this.initializeItems();

    // set q to the value of the searchbar
    var q = searchbar.srcElement.value;


    // if the value is an empty string don't filter the items
    if (!q) {
      return;
    }

    this.filteredReceipts = this.receipts.filter((v) => {
      if(v.title && q) {
        if (v.title.toLowerCase().indexOf(q.toLowerCase()) > -1) {
          return true;
        }
        return false;
      }
    });
  }

  loadReceiptImage(event, receipt){
    //this.userApi.getSpecificReceiptImage = receipt.title;
    this.navCtrl.push(Page1, {receipt : receipt });
  }
}
