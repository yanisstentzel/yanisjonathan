from mymodule.basics import *
'''Ne pas hésiter à documenter'''
def test_abs_value():
    assert valeur_abs(-10) == 10, "Erreur sur la valeur absolue"
    assert valeur_abs(10) == 10
    assert valeur_abs(0) == 0   