import {Component, OnInit, ViewChild} from '@angular/core';
import {Breadcrumb} from "../breadcrumb/breadcrumb";
import {Password} from "./password";
import {FormBuilder, FormGroup, Validators} from "@angular/forms";
import {ActivatedRoute, Router} from "@angular/router";
import {LoginService} from "../login/login.service";
import {AlertService} from "../alert.service";
import * as _ from 'lodash';
import 'rxjs/add/operator/map';
import {DynamicDirective} from "../dynamic.directive";

@Component({
  selector: 'app-reset-password',
  templateUrl: './reset-password.component.html',
  styleUrls: ['./reset-password.component.css']
})
export class ResetPasswordComponent implements OnInit {
    breadcrumbLinks: Breadcrumb[] = [
        {link: '', label: 'Home'},
        {link: null, label: 'Reset password'}
    ];
    password: Password = new Password();
    passwordForm: FormGroup;
    token: string;

    @ViewChild(DynamicDirective) dynamic: DynamicDirective;

  constructor(
      private fb: FormBuilder,
      private router: Router,
      private activatedRoute: ActivatedRoute,
      private loginService: LoginService,
      private alertService: AlertService
  ) { }

  ngOnInit() {
      this.activatedRoute.queryParams
          .map(params => params['token'])
          .subscribe(token => {
            console.log(token);
              this.loginService.resetPasswordGet(token)
                  .subscribe(
                      (result: any) => {
                          console.log(result);
                          if(result.error) {
                              this.alertService.setAlert('warning', result.error);
                              this.router.navigate(['/']);
                          }
                      },
                  );
            this.token = token;
          });

      this.passwordForm = this.fb.group({
          password: [
              this.password.password,
              Validators.compose([
                  Validators.required,
                  Validators.minLength(6),
                  Validators.maxLength(255)
              ])
          ]
      });
  }

    onSubmit(form) {
        console.log(form);
        this.loginService.resetPasswordPost(this.token, {ResetPasswordForm: form.value})
            .subscribe(
                (result: any) => {
                    console.log(result);
                    if(result.success) {
                        this.alertService.setAlert('success', result.success)
                    }
                    if(result.error) {
                        this.alertService.setAlert('warning', result.error)
                    }
                    form.setValue(new Password());
                    this.router.navigate(['/']);
                },
                err => {
                    console.log(err);
                    if(err.status == 422) {
                        let errors = JSON.parse(err.error);
                        _.forEach(errors, (value) => {
                            form.controls[value.field].setErrors({'backend': value.message});
                        });
                    }
                }
            );
    }
}
