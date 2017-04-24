import { Component } from '@angular/core';
import { Http, Headers } from '@angular/http';
import { NavController, NavParams, LoadingController } from 'ionic-angular';
import { UserApi, User, AuthService, UserGlobals } from './../shared/user-api.service';
import { NgForm } from '@angular/forms/src/directives';
import { HsaPoster } from './../shared/hsa-post.service';

import { addHsaModel } from './../../models/addhsa.model';

@Component({
  selector: 'page-add-hsa',
  templateUrl: 'add-hsa.html'
})
export class AddHSAPage {

  
  
  userinfo: any;
  results: any;
  model = new addHsaModel(this.userGlobals.getGlobalEmail(), "", this.userGlobals.getGlobalSession());

  constructor(public navCtrl: NavController, public navParams: NavParams, private http: Http, public loadingController: LoadingController, public hsaPoster: HsaPoster, public userGlobals: UserGlobals) {
    this.userinfo = navParams.get('userinfo');
    console.log("userinfo passed from accounts: ", this.userinfo);
  }

  ionViewDidLoad() {
    console.log('ionViewDidLoad AddHSAPage');

  }

  addHsaForm(form: NgForm) {
    let loader = this.loadingController.create({
      content: 'Adding Account...'
    });

    loader.present().then(() => {
        console.log("this is the add", form.value);
        this.hsaPoster.postHsaAddForm(this.model)
        .subscribe(
          data => {this.results = data; console.dir(data);},
          //err => console.log('error: ', err),
          () => console.log('results: ', this.results),
        );
        loader.dismiss();
        this.goBack();
    });
  }

  goBack() {
    this.navCtrl.pop();
  }
  /*
  goBackSuccess() {
    this.navCtrl.pop();
    location.reload();
  }
  */

}
