import { processLintResults } from '@ionic/app-scripts/dist/lint/lint-utils';
import { Component } from '@angular/core';
import { Http, Headers } from '@angular/http';
import { NavController, NavParams, LoadingController } from 'ionic-angular';
import { YelpPoster } from './../shared/yelp-api-post.service';
import { YelpSearchModel } from './../../models/yelpsearch.model';
import { NgForm } from '@angular/forms/src/directives';

// Page import
import { YelpResultPage } from './../yelp-result/yelp-result';

/*
  Generated class for the Services page.

  See http://ionicframework.com/docs/v2/components/#navigation for more info on
  Ionic pages and navigation.
*/
@Component({
  selector: 'page-services',
  templateUrl: 'services.html'
})
export class ServicesPage {
  model = new YelpSearchModel('Dentist', '65201', '40000', '2');
  
  results: any;
  private resultData: any;

  constructor(public navCtrl: NavController, public navParams: NavParams, private http: Http, private yelpPoster: YelpPoster, private loadingController: LoadingController) { 
  }
  // form method
  submitForm(form: NgForm) {
    let loader = this.loadingController.create({
      content: 'Finding Services Near You...'
    });

    loader.present().then(() => {
        // Validation should go up here if we get this far
        console.log(form.value);
        this.yelpPoster.postYelpSearchForm(this.model)
        .subscribe(
          data => this.results = data.businesses,
          //data => this.results = data,
          //data => console.log('success: ', data),
          err => console.log('error: ', err),
          () => console.log('results: ', this.results),
        );
        loader.dismiss();
    });
    
  }

  serviceClicked(event, result){
    this.navCtrl.push(YelpResultPage, { result: result });
    //this.navCtrl.push(YelpResultPage);
  }

  ionViewDidLoad() {
    console.log('ionViewDidLoad ServicesPage')
    };
  }
