import { Component } from '@angular/core';
import { Http, Headers } from '@angular/http';
import { NavController, NavParams, LoadingController } from 'ionic-angular';
import { UserApi, User, AuthService, UserGlobals } from './../shared/user-api.service';
import { NgForm } from '@angular/forms/src/directives';
import { FsaPoster } from './../shared/fsa-post.service';
import { addFsaModel } from './../../models/addfsa.model';

@Component({
  selector: 'page-add-fsa',
  templateUrl: 'add-fsa.html'
})
export class AddFSAPage {
  
  userinfo: any;
  results: any;
  successStatus: any;
  model = new addFsaModel(this.userGlobals.getGlobalEmail(), "", this.userGlobals.getGlobalSession());

  constructor(public navCtrl: NavController, public navParams: NavParams, private http: Http, public loadingController: LoadingController, public fsaPoster: FsaPoster, public userGlobals: UserGlobals) {
    this.userinfo = navParams.get('userinfo');
    console.log("userinfo passed from accounts: ", this.userinfo);
  }

  ionViewDidLoad() {
    console.log('ionViewDidLoad AddFSAPage');

  }

  addFsaForm(form: NgForm) {
    let loader = this.loadingController.create({
      content: 'Adding Account...'
    });

    loader.present().then(() => {
        console.log("this is the add", form.value);
        this.fsaPoster.postFsaAddForm(this.model)
        .subscribe(
          data => {this.results = data; console.dir(data);
            if(data == `Error: could not add FSA account.`){
              this.successStatus = false;
              console.log("SuccessStatus: ", this.successStatus)
            }else{
              this.successStatus = true;
              console.log("SuccessStatus: ", this.successStatus)
            }
          },
          //err => console.log('error: ', err),
          () => console.log('results: ', this.results),
          
        );
        loader.dismiss();
        this.userGlobals.sleep(3500).then(() => {
          this.goBack();
        });
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
