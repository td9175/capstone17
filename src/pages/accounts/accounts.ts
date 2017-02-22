//import { ReportsPage } from './../reports/reports';
import { HSAPage } from '../hsa/hsa';
import { FSAPage } from './../fsa/fsa';
import { LoginPage } from '../login/login';
import { Component } from '@angular/core';
import { NavController, NavParams } from 'ionic-angular';
import { ActionSheetController } from 'ionic-angular';

@Component({
  selector: 'page-accounts',
  templateUrl: 'accounts.html'
})
export class AccountsPage {

  constructor(public navCtrl: NavController, public navParams: NavParams, public actionSheetCtrl: ActionSheetController) {}

  // all of these console logs are just tests, delete in later versions please.
  ionViewDidLoad() {
    console.log('ionViewDidLoad AccountsPage');
  }

  helloTest() {
    console.log('Hello, World!');
  }
  
  hsaTest() {
    this.navCtrl.push(HSAPage);
  }

  fsaTest() {
    this.navCtrl.push(FSAPage);
  }

  loginTest() {
    this.navCtrl.push(LoginPage);
  }

  // action sheet popup test

  presentActionSheet() {
    let actionSheet = this.actionSheetCtrl.create({
      title: 'Modify your album',
      buttons: [
        {
          text: 'FSA Page',
          role: 'destructive',
          handler: () => {
            console.log('Destructive Option 1 clicked');
            this.navCtrl.push(HSAPage);
          }
        },{
          text: 'FSA Page',
          handler: () => {
            console.log('Regular Option 2 clicked');
            this.navCtrl.push(FSAPage);
          }
        },{
          text: 'Cancel',
          role: 'cancel',
          handler: () => {
            console.log('Cancel clicked');
          }
        }
      ]
    });
    actionSheet.present();

  }
}
