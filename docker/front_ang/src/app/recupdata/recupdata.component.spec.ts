import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { RecupdataComponent } from './recupdata.component';

describe('RecupdataComponent', () => {
  let component: RecupdataComponent;
  let fixture: ComponentFixture<RecupdataComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ RecupdataComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(RecupdataComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
