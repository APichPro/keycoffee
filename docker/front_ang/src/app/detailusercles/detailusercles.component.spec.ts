import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { DetailuserclesComponent } from './detailusercles.component';

describe('DetailuserclesComponent', () => {
  let component: DetailuserclesComponent;
  let fixture: ComponentFixture<DetailuserclesComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ DetailuserclesComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(DetailuserclesComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
