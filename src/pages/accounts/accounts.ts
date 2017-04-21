import { AccountDetailPage } from './../account-detail/account-detail';
import { UserApi } from './../shared/user-api.service';
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

  userhsas: any;
  userfsas: any;
  // accountType: any;

  constructor(public navCtrl: NavController, public navParams: NavParams, public actionSheetCtrl: ActionSheetController, private userApi: UserApi) { 
  }

  ionViewDidLoad() {
    // get HSA Data
    this.userApi.getUserHSAData().then(data => this.userhsas = data);
    this.userApi.getUserFSAData().then(data => this.userfsas = data);
  }

  // for debugging.
  loginTest() {
    this.navCtrl.push(LoginPage);
  }

  // Commented out michael's code for now, causing some errors.
  /*
  loadHsaAccountDetails(event, accountType){
    accountType = "HSA";
    this.navCtrl.push(AccountDetailPage, { accountType: accountType });
  }

  loadFsaAccountDetails(event, accountType){
    accountType = "FSA";
    this.navCtrl.push(AccountDetailPage, { accountType: accountType });
  }
  */
}
