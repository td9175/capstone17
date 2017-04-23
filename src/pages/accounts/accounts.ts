import { Component } from '@angular/core';
import { NavController, NavParams } from 'ionic-angular';
import { ActionSheetController } from 'ionic-angular';
import { UserApi, UserGlobals, AuthService } from './../shared/user-api.service';

// Page Imports
import { UserSettingsPage } from './../user-settings/user-settings';
import { AccountDetailPage } from './../account-detail/account-detail';
import { HSAPage } from '../hsa/hsa';
import { FSAPage } from './../fsa/fsa';
import { LoginPage } from '../login/login';
import { AboutPage } from '../about/about';
import { HelpPage } from './../help/help';
import { TaxInfoPage } from './../tax-info/tax-info';

@Component({
  selector: 'page-accounts',
  templateUrl: 'accounts.html'
})
export class AccountsPage {

  userhsas: any;
  userfsas: any;
  loggedInUser: any;
  userLoggedIn: any;

  userhsabalance: any;
  // userfsabalance: any;
  // accountType: any;

  constructor(public navCtrl: NavController, public navParams: NavParams, public actionSheetCtrl: ActionSheetController, private userApi: UserApi, public userGlobals: UserGlobals, public authService: AuthService) { 
  }

  ionViewDidLoad() {
    // get HSA-FSA Data
    this.userApi.getUserHSAData().then(data => this.userhsas = data);
    this.userApi.getUserFSAData().then(data => this.userfsas = data);
    this.loggedInUser = this.userGlobals.getGlobalEmail();
    if(this.userGlobals.isLoggedIn()==true) {
      this.userLoggedIn = true;
    } else {
      this.userLoggedIn = false;
    }
    // would it be redundant to show balance here? Would we rather have them click on the account.
    //this.userApi.getHsaBalance().then(data => this.userhsabalance);
    //this.userApi.getFsaBalance().then(data => this.userfsabalance);
  }

  // for debugging.
  loginTest() {
    this.navCtrl.push(LoginPage);
  }

  logoutTest() {
    this.authService.appLogout();
    this.navCtrl.popToRoot();
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
  
  loadHelpPage(){
    this.navCtrl.push(HelpPage);
  }

  loadTaxHelpPage(){
    this.navCtrl.push(TaxInfoPage);
  }

  loadAboutPage(){
    this.navCtrl.push(AboutPage);
  }

}
