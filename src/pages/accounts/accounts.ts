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
  userHasHsa: boolean;

  userfsas: any;
  userinfos: any;
  loggedInUser: any;
  userLoggedIn: any;

  userhsabalance: any;
  // userfsabalance: any;
  // accountType: any;

  constructor(public navCtrl: NavController, public navParams: NavParams, public actionSheetCtrl: ActionSheetController, private userApi: UserApi, public userGlobals: UserGlobals, public authService: AuthService) { 
  }

  ionViewDidLoad() {
    // get HSA-FSA Data
    // this.userApi.getUserHSAData().then(data => this.userhsas = data);
    // this.userApi.getUserFSAData().then(data => this.userfsas = data);
    this.userApi.getUserInfoData().then(data => this.userinfos = data);
    this.loggedInUser = this.userGlobals.getGlobalEmail();
    if(this.userGlobals.isLoggedIn()==true) {
      this.userLoggedIn = true;
      this.loadJsonFiles();
    } else {
      this.userLoggedIn = false;
    }
    // would it be redundant to show balance here? Would we rather have them click on the account.
    //this.userApi.getHsaBalance().then(data => this.userhsabalance);
    //this.userApi.getFsaBalance().then(data => this.userfsabalance);
  }
  loadJsonFiles(){
    this.userApi.getUserHSAData().then(
      data => {
        if (data == `No HSA account exists for clark@gmail.com. Add an HSA account now.`) {
          this.userHasHsa = false;
          console.log('userHasHSA: ', this.userHasHsa);
        } else {
          this.userHasHsa = true;
          this.userhsas = data;
          console.log('userHasHSA: ', this.userHasHsa);
          console.log('userHasHSA: ', this.userhsas);
        }
      },
    );
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
