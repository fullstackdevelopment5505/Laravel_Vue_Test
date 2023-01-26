import { shallowMount } from '@vue/test-utils';
import SignIn from '../../src/views/Login';

describe('SignIn', () => {
  let wrapper;
  let signInComponent;
  let input;

  const setData = values => {
    if (!values) {
      wrapper.setData({
        input: {
          email: 'Fulano',
          password: 123456
        },
      });
    } else {
      wrapper.setData({
        input: {
          ...values,
        },
      });
    }
  };

  const resetData = () => {
    wrapper.setData({
      input: {
        email: '',
        password: '',
      },
    });
  };

  beforeEach(() => {
    wrapper = shallowMount(SignIn, {
      sync: false
    });

    signInComponent = wrapper.vm;
    input = signInComponent.$data.input;
  });

  test('should SignIn is a Vue instance', () => {
    expect(wrapper).toBeTruthy();
  });

  test('should computed property isValid is false', () => {
    expect(signInComponent.isValid).toBeFalsy();
  });

  test('should the correct properties are present in the component state', () => {
    const userProperties = Object.keys(input);
    const expectedProperties = ['email', 'password'];

    expect(userProperties).toEqual(expectedProperties);
  });

  test('should isValid must be false if not username assign to the user property ', () => {
    wrapper.setData({
      input: {
        email: '',
        password: '123456',
      },
    });

    expect(signInComponent.isValid).toBeFalsy();
  });

  test('should isValid must be false if not password assign to the user property ', () => {
    wrapper.setData({
      input: {
        email: 'Fulano',
        password: '',
      },
    });

    expect(signInComponent.isValid).toBeFalsy();
  });

  test('should reset the values of user if change the navigation property', async () => {
    const mockUser = {
      email: '',
      password: ''
    };

    setData();

    await signInComponent.$nextTick();

    expect(input).toEqual(mockUser);
    expect(signInComponent.isValid).toBeFalsy();
  });


  test('should set invalid class if username input is typed and after cleaned', async () => {
    const userInput = wrapper.find('#email');
    const isInvalidCssClass = userInput.classes('invalid');

    expect(isInvalidCssClass).toBeFalsy();

    //simulate teh user(person) type in username input
    setData({
      email: 'Beltrano',
    });

    userInput.trigger('input');

    await wrapper.vm.$nextTick();

    //simulate user(person) erase
    resetData();

  });

  test('should set invalid class if password input is typed and after cleaned', async () => {
    const userInput = wrapper.find('#pass');
    const isInvalidCssClass = userInput.classes('invalid');

    expect(isInvalidCssClass).toBeFalsy();

    //simulate teh user(person) type in email input
    setData({
      email: 'Beltrano',
    });

    userInput.trigger('input');

    await wrapper.vm.$nextTick();

    //simulate user(person) erase
    resetData();
  });
});