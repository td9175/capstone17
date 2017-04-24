import { NgModule, ErrorHandler } from '@angular/core';
import { IonicApp, IonicModule, IonicErrorHandler } from 'ionic-angular';
import io from 'socket.io-client';
window["io"] = io;

// Page Imports
import { HomePage } from './../pages/home/home';
import { RegisterPage } from './../pages/register/register';
import { UserSettingsPage } from './../pages/user-settings/user-settings';
import { VaultPage } from './../pages/vault/vault';
import { ServicesPage } from './../pages/services/services';
import { ProductsPage } from './../pages/products/products';
import { LoginPage } from './../pages/login/login';
import { TaxInfoPage } from './../pages/tax-info/tax-info';
import { HelpPage } from './../pages/help/help';
import { ReportsPage } from './../pages/reports/reports';
import { AboutPage } from './../pages/about/about';
import { AccountsPage } from './../pages/accounts/accounts';
import { MyVaultPage } from './../pages/my-vault/my-vault'; 
import { ReceiptFormPage } from './../pages/receipt-form/receipt-form';
import { AccountDetailPage } from './../pages/account-detail/account-detail';
import { ProductDetail } from './../pages/product-detail/product-detail';
import { AddReceiptPage } from './../pages/add-receipt/add-receipt';

import { AddFSAPage } from './../pages/add-fsa/add-fsa';
import { AddHSAPage } from './../pages/add-hsa/add-hsa';

// Page 1 Dev Page
import { Page1 } from '../pages/page1/page1';

// APIs
import { YelpPoster } from './../pages/shared/yelp-api-post.service';
import { HsaPoster } from './../pages/shared/hsa-post.service';
import { FsaPoster } from './../pages/shared/fsa-post.service';
import { User, UserApi, AuthService, UserGlobals } from './../pages/shared/user-api.service';
//import { ReceiptPoster } from './../pages/shared/receipt-post.service';
import { YelpResultPage } from './../pages/yelp-result/yelp-result';
import { HsaTransactionPoster } from './../pages/shared/receipt-HSAtransaction-post.service';
import { FsaTransactionPoster } from './../pages/shared/receipt-FSAtransaction-post.service';


import { MyApp } from './app.component';
import { Camera } from '@ionic-native/camera';

import { ActionSheet, ActionSheetOptions } from '@ionic-native/action-sheet'
import { ActionSheetController } from 'ionic-angular';
import { NgForm } from '@angular/forms/src/directives';

@NgModule({
  declarations: [
    HomePage,
    RegisterPage,
    MyApp,
    AccountsPage,
    AddHSAPage,
    AddFSAPage,
    AboutPage,
    ReportsPage,
    HelpPage,
    LoginPage,
    ProductsPage,
    ServicesPage,
    YelpResultPage,
    TaxInfoPage,
    VaultPage,
    UserSettingsPage,
    Page1,
    MyVaultPage,
    AddReceiptPage,
    ProductDetail,
    AccountDetailPage,
    ReceiptFormPage
  ],
  imports: [
    IonicModule.forRoot(MyApp)
  ],
  bootstrap: [IonicApp],
  entryComponents: [
    MyApp,
    HomePage,
    RegisterPage,
    AccountsPage,
    AddHSAPage,
    AddFSAPage,
    AboutPage,
    ReportsPage,
    HelpPage,
    LoginPage,
    ProductsPage,
    ServicesPage,
    YelpResultPage,
    TaxInfoPage,
    VaultPage,
    UserSettingsPage,
    Page1,
    MyVaultPage,
    AddReceiptPage,
    ProductDetail,
    AccountDetailPage,
    ReceiptFormPage
  ],
  providers: [YelpPoster, HsaPoster, FsaPoster, HsaTransactionPoster , FsaTransactionPoster, {provide: ErrorHandler, useClass: IonicErrorHandler}, Camera, ActionSheet, ActionSheetController, AuthService, User, UserApi, UserGlobals, NgForm]
})
export class AppModule {}
