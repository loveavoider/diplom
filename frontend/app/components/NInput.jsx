import {NumberInput, NumberInputField} from "@chakra-ui/react";

export default function NInput({placeholder, def, onChange, mt, width = "100%"}) {
    return (
        <NumberInput defaultValue={def} mt={mt} width={width}>
            <NumberInputField onChange={onChange} placeholder={placeholder} border="1px" borderColor="gray.300" borderRadius="10px" />
        </NumberInput>
    )
}