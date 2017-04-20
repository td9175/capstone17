import { MyVaultPage } from './../my-vault/my-vault';
import { AddReceiptPage } from './../add-receipt/add-receipt';
import { Component } from '@angular/core';
import { NavController, NavParams } from 'ionic-angular';
import { Camera } from '@ionic-native/camera';
import { ReceiptPoster } from './../shared/receipt-post.service';
import { ActionSheet, ActionSheetOptions } from '@ionic-native/action-sheet'

/*
  Generated class for the Vault page.

  See http://ionicframework.com/docs/v2/components/#navigation for more info on
  Ionic pages and navigation.
*/
@Component({
  selector: 'page-vault',
  templateUrl: 'vault.html'
})
export class VaultPage {

  constructor(public navCtrl: NavController, public navParams: NavParams, public camera: Camera, public receiptPoster: ReceiptPoster, private actionSheet: ActionSheet) {}

  ionViewDidLoad() {
    console.log('ionViewDidLoad VaultPage');
  }

  fireUploadSheet() {
    
  }

  loadAddRecieptPage(){
    this.navCtrl.push(AddReceiptPage)
  }

  loadUploadPage(){

  }

  loadMyVaultPage(){
    this.navCtrl.push(MyVaultPage);
  }

}
