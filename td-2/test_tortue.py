from mymodule.tortue import *
import pytest
'''Ne pas hésiter à documenter'''

@pytest.fixture
def caroline():
    return Tortue('Caroline')

def test_init(caroline):
    assert caroline.nom == "Caroline"
    assert caroline.position == 0