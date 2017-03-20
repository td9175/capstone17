import { AddReceiptPage } from './../pages/add-receipt/add-receipt';
import { NgModule, ErrorHandler } from '@angular/core';
import { IonicApp, IonicModule, IonicErrorHandler } from 'ionic-angular';
import io from 'socket.io-client';
window["io"] = io;

import { HomePage } from './../pages/home/home';
import { UserSettingsPage } from './../pages/user-settings/user-settings';
import { VaultPage } from './../pages/vault/vault';
import { ServicesPage } from './../pages/services/services';
import { ProductsPage } from './../pages/products/products';
import { LoginPage } from './../pages/login/login';
import { HSAPage } from './../pages/hsa/hsa';
import { FSAPage } from './../pages/fsa/fsa';
import { TaxInfoPage } from './../pages/tax-info/tax-info';
import { HelpPage } from './../pages/help/help';
import { ReportsPage } from './../pages/reports/reports';
import { AboutPage } from './../pages/about/about';
import { AccountsPage } from './../pages/accounts/accounts';
import { MyVaultPage } from './../pages/my-vault/my-vault'; 

import { MyApp } from './app.component';
import { Page1 } from '../pages/page1/page1';
import { Page2 } from '../pages/page2/page2';

@NgModule({
  declarations: [
    HomePage,
    MyApp,
    AccountsPage,
    Page1,
    AboutPage,
    ReportsPage,
    HelpPage,
    FSAPage,
    HSAPage,
    LoginPage,
    ProductsPage,
    ServicesPage,
    TaxInfoPage,
    VaultPage,
    UserSettingsPage,
    Page2,
    MyVaultPage,
    AddReceiptPage
  ],
  imports: [
    IonicModule.forRoot(MyApp)
  ],
  bootstrap: [IonicApp],
  entryComponents: [
    MyApp,
    HomePage,
    AccountsPage,
    Page1,
    AboutPage,
    ReportsPage,
    HelpPage,
    FSAPage,
    HSAPage,
    LoginPage,
    ProductsPage,
    ServicesPage,
    TaxInfoPage,
    VaultPage,
    UserSettingsPage,
    Page2,
    MyVaultPage,
    AddReceiptPage
  ],
  providers: [{provide: ErrorHandler, useClass: IonicErrorHandler}]
})
export class AppModule {}
