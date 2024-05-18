import {Editable, EditableInput, EditablePreview} from "@chakra-ui/react";

export default function Input({placeholder, onChange, mt, def}) {
    return (
        <Editable defaultValue={def} mt={mt} onChange={onChange} placeholder={placeholder} width="100%" border="1px" borderColor="gray.300" borderRadius="10px" h="40px">
            <EditablePreview w="100%" h="38px" />
            <EditableInput w="100%" h="38px" />
        </Editable>
    );
}