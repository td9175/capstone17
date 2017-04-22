import { Component } from '@angular/core';
import { NavController, NavParams } from 'ionic-angular';
import { ActionSheetController } from 'ionic-angular';
import { UserApi, UserGlobals } from './../shared/user-api.service';

// Page Imports
import { UserSettingsPage } from './../user-settings/user-settings';
import { AccountDetailPage } from './../account-detail/account-detail';
import { HSAPage } from '../hsa/hsa';
import { FSAPage } from './../fsa/fsa';
import { LoginPage } from '../login/login';


@Component({
  selector: 'page-accounts',
  templateUrl: 'accounts.html'
})
export class AccountsPage {

  userhsas: any;
  userfsas: any;

  userhsabalance: any;
  // userfsabalance: any;
  // accountType: any;

  constructor(public navCtrl: NavController, public navParams: NavParams, public actionSheetCtrl: ActionSheetController, private userApi: UserApi, public userGlobals: UserGlobals) { 
  }

  ionViewDidLoad() {
    // get HSA-FSA Data
    this.userApi.getUserHSAData().then(data => this.userhsas = data);
    this.userApi.getUserFSAData().then(data => this.userfsas = data);
    // would it be redundant to show balance here? Would we rather have them click on the account.
    //this.userApi.getHsaBalance().then(data => this.userhsabalance);
    //this.userApi.getFsaBalance().then(data => this.userfsabalance);
  }

  // for debugging.
  loginTest() {
    this.navCtrl.push(LoginPage);
  }
  
  loadHsaAccountDetails(event, accountType){
    accountType = "HSA";
    this.navCtrl.push(AccountDetailPage, { accountType: accountType });
  }

  loadFsaAccountDetails(event, accountType){
    accountType = "FSA";
    this.navCtrl.push(AccountDetailPage, { accountType: accountType });
  }

  loadUserSettingsDetails(){
    this.navCtrl.push(UserSettingsPage);
  }
  
}
