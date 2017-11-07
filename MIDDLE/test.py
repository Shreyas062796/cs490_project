import sys

func = sys.argv[2];
func = func.replace("_", " ")
func = func.replace("]", ")")
func = func.replace("[", "(")

#print("FUNCTION:")
#print(func)

exec(func)	

#generate python command by getting the name adding parameters
function_name = sys.argv[1];

py_command = "print(str(" + function_name + "("

for i in range(3, len(sys.argv)):
	py_command += sys.argv[i]
	if(i < len(sys.argv) - 1):
		py_command += ", "
	else:
		py_command += ")))"

#print(py_command)

#execute python command
try:
	exec(py_command)
except Exception as err:
	print(err.message)

