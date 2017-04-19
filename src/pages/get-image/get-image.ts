import { processLintResults } from '@ionic/app-scripts/dist/lint/lint-utils';
import { Component } from '@angular/core';
import { Http, Headers } from '@angular/http';
import { NavController, NavParams, LoadingController } from 'ionic-angular';
import { ReceiptPoster } from './../shared/receipt-post.service';
import { OcrUploadImageModel } from './../../models/ocruploadimage.model';
import { NgForm } from '@angular/forms/src/directives';

// Page import
//import { YelpResultPage } from './../yelp-result/yelp-result';

@Component({
  selector: 'page-get-image',
  templateUrl: 'get-image.html'
})
export class GetImagePage {
  model = new OcrUploadImageModel('');
  
  ocrreply: any;
  private resultData: any;

  constructor(public navCtrl: NavController, public navParams: NavParams, private http: Http, private receiptPoster: ReceiptPoster, private loadingController: LoadingController) { 
  }
  // form method
  submitForm(form: NgForm) {
    let loader = this.loadingController.create({
      content: 'Processing receipt...'
    });

    loader.present().then(() => {
        console.log(form.value);
        this.receiptPoster.postReceiptForm(this.model)
        .subscribe(
          data => this.ocrreply = data.somethingReturned,
          err => console.log('error: ', err),
          () => console.log('Something returned: ', this.ocrreply),
        );
        loader.dismiss();
    });
    
  }

  // serviceClicked(event, result){
  //   this.navCtrl.push(YelpResultPage, { result: result });
  // }

  ionViewDidLoad() {
    console.log('ionViewDidLoad GetImagePage')
    };
  }
